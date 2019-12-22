$(function() {
    const chatBox = document.getElementById("chat-box");
    const isiChat = document.getElementById("isi-chat");
    const btnChat = document.getElementById("btn-chat");

    btnChat.addEventListener("click", function() {
        $.ajax({
            url: "add-chat.php",
            data: {
                isi: isiChat.value
            },
            method: "post",
            success: function(res) {
                isiChat.value = "";
            }
        });
    });

    setInterval(() => {
        $.ajax({
            url: "chat.php",
            data: { id: 2 },
            method: "post",
            dataType: "json",
            success: function(res) {
                chatBox.innerHTML = "";
                let str = "";
                res.forEach(element => {
                    str += `<div class="item">
                    <img src="assets/foto/${element.role}/profile/${element.user.foto}" alt="user image" class="online">
        
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> ${element.waktu}</small>
                            ${element.user.nama}
                        </a>
                        ${element.isi}
                    </p>
                </div>`;
                });
                chatBox.innerHTML = str;
            }
        });
    }, 1000);
});
