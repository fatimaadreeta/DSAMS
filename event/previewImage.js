const fileInput = document.getElementById('posterImg');

const previewImage = document.getElementById('preview-image');

fileInput.addEventListener('change', event => {
if (event.target.files.length > 0) {
    previewImage.src = URL.createObjectURL(
    event.target.files[0],
    );

    previewImage.style.display = 'block';
}
});