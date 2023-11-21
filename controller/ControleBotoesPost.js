document.getElementById("button-imagens").addEventListener("click", function (){
    document.getElementById("input-imagens").click();
});

document.getElementById('input-imagens').addEventListener('change', function(e) {
    var file = e.target.files[0]; 

    var reader = new FileReader();
    reader.onload = function(event) {
        var imageUrl = event.target.result;
        var imgElement = document.createElement('img');
        imgElement.src = imageUrl;
        document.body.appendChild(imgElement);
    };
    reader.readAsDataURL(file);
});