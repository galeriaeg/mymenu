document.addEventListener('DOMContentLoaded', () => {
    const imageInput = document.getElementById('imageInput');
    const imageToCrop = document.getElementById('imageToCrop');
    const cropButton = document.getElementById('cropButton');
    const croppedImagePreview = document.getElementById('croppedImagePreview');
    let cropper; // Variável para armazenar a instância do Cropper.js

    // Oculta a imagem e o botão de recorte inicialmente
    imageToCrop.style.display = 'none';
    cropButton.style.display = 'none';

    imageInput.addEventListener('change', (event) => {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    imageToCrop.src = e.target.result;
                    imageToCrop.style.display = 'block'; // Exibe a imagem

                    // Destrói a instância anterior do Cropper se existir
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Inicializa o Cropper.js na imagem
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 14 / 10, // Define a proporção do recorte (ex: 16:9). Use NaN para proporção livre.
                        viewMode: 1, // 0: sem restrições, 1: imagem dentro da área de recorte, 2: área de recorte dentro da imagem, 3: área de recorte preenche o container.
                        autoCropArea: 0.8, // Área de auto-recorte inicial (0 a 1)
                        // zoomable: false, // Desabilita o zoom se preferir
                        // background: false, // Remove o fundo quadriculado
                        // crop(event) {
                        //     // Callback que é disparado durante o recorte (opcional)
                        //     console.log(event.detail.x);
                        //     console.log(event.detail.y);
                        //     console.log(event.detail.width);
                        //     console.log(event.detail.height);
                        // }
                    });
                    cropButton.style.display = 'block'; // Exibe o botão de recortar
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor, selecione um arquivo de imagem.');
                imageToCrop.style.display = 'none';
                cropButton.style.display = 'none';
            }
        }
    });

    cropButton.addEventListener('click', () => {
        if (cropper) {
            // Obtém a imagem recortada como um blob
            cropper.getCroppedCanvas().toBlob((blob) => {
                const croppedImageUrl = URL.createObjectURL(blob);
                croppedImagePreview.src = croppedImageUrl;

                // Aqui você pode fazer o upload do 'blob' para o servidor
                // Exemplo de como você faria o upload (usando FormData):
                /*
                const formData = new FormData();
                formData.append('croppedImage', blob, 'cropped-image.png'); // 'cropped-image.png' é o nome do arquivo no servidor

                fetch('/upload-image', { // Substitua por sua URL de upload
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Upload successful:', data);
                    alert('Imagem recortada e enviada com sucesso!');
                })
                .catch(error => {
                    console.error('Upload failed:', error);
                    alert('Falha ao enviar a imagem.');
                });
                */

                alert('Imagem recortada! Verifique a pré-visualização. Você pode agora implementar a lógica de upload com o "blob" gerado.');

            }, 'image/png'); // Você pode especificar o tipo de imagem de saída (image/jpeg, image/png, etc.)
        } else {
            alert('Nenhuma imagem carregada ou Cropper não inicializado.');
        }
    });
});