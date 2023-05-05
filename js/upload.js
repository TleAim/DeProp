const dropzone = document.getElementById('dropzone');
const thumbnails = document.getElementById('thumbnails');
const NextStep = document.getElementById('NextStep');

let selectedFiles = [];

function createThumbnail(file) {
    // Create container for thumbnail and delete button
    const container = document.createElement('div');
    container.style.display = 'inline-block';
    container.style.position = 'relative';

    const thumbnail = document.createElement('img');
    thumbnail.classList.add('thumbnail');
    const reader = new FileReader();
    reader.onload = function (event) {
        thumbnail.src = event.target.result;
    };
    reader.readAsDataURL(file);
    container.appendChild(thumbnail);

    // Add delete button
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'ยกเลิก';
    deleteBtn.style.position = 'absolute';
    deleteBtn.style.bottom = '0';
    deleteBtn.style.left = '50%';
    deleteBtn.style.transform = 'translateX(-50%)';
    deleteBtn.style.color = 'white'; // White text color
    deleteBtn.style.backgroundColor = 'red'; // Red background
    deleteBtn.style.border = '2px solid white'; // White border, 2px wide
    deleteBtn.style.borderRadius = '5px'; // Smooth corners, 5px radius
    deleteBtn.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.25)'; // Add a shadow


    deleteBtn.addEventListener('click', function () {
        selectedFiles = selectedFiles.filter(f => f !== file);
        thumbnails.removeChild(container);
    });
    container.appendChild(deleteBtn);

    thumbnails.appendChild(container);
}


dropzone.addEventListener('click', function () {
    const input = document.createElement('input');
    input.type = 'file';
    input.multiple = true;
    input.accept = 'image/*';
    input.addEventListener('change', function (event) {
        const files = Array.from(event.target.files);
        files.slice(0, 10 - selectedFiles.length).forEach(file => {
            if (file.size <= 5 * 1024 * 1024 && selectedFiles.length < 10) {
                selectedFiles.push(file);
                createThumbnail(file);
            }
        });
    });
    input.click();
});

dropzone.addEventListener('dragover', function (event) {
    event.preventDefault();
    dropzone.style.backgroundColor = '#f0f0f0';
});

dropzone.addEventListener('dragleave', function () {
    dropzone.style.backgroundColor = '';
});

dropzone.addEventListener('drop', function (event) {
    event.preventDefault();
    dropzone.style.backgroundColor = '';
    const files = Array.from(event.dataTransfer.files);
    files.slice(0, 10 - selectedFiles.length).forEach(file => {
        if (file.size <= 5 * 1024 * 1024 && selectedFiles.length < 10) {
            selectedFiles.push(file);
            createThumbnail(file);
        }
    });
});
 

NextStep.addEventListener('click', function () {
    
    if (selectedFiles.length === 0){
        alert("กรุณาใส่รูปสินทรัพย์อย่างน้อย 1 รูป");
        return;
    }else if(selectedFiles.length>10){
        alert("ใส่รูปสินทรัพย์ได้สูงสุด 10 รูปเท่านั้น");
        return;
    } 

    const formData = new FormData();

    selectedFiles.forEach((file, index) => {
        formData.append(`file${index}`, file);
    });
    fetch('upload_process.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            response.text().then(text => {
                console.log(text);
                console.log("Upload success");
                // Redirect to index.php instead of showing an alert
                //alert('Images uploaded successfully');
                window.location.href = 'newpost2.php';
            });
        } else {
            //alert('Error uploading images');
        }
    }).catch(error => {
        console.error(error);
        //alert('Error uploading images');
    });
});

  


