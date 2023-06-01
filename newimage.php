<div class="container-fluid bg-white">
    <div class="p-3 text-center">
    <p class="pt-3 text-primary fw-bold dynamic-font">เพิ่มรูปภาพสินทรัพย์(สูงสุด 8 รูป)</p>
    <form action="upload_process.php" method="POST" enctype="multipart/form-data">
    <div class=""></div>
    
            <div class="d-flex flex-wrap mt-3 p-0">
                <?php for ($i = 1; $i <= 8; $i++) { ?>
                <div class="d-flex flex-column">
                    <div id="imageBox<?=$i?>" class="image-box mx-2 my-2 p-0" onclick="browseImage('image<?=$i?>')">
                        <input type="file" id="image<?=$i?>" name="image<?=$i?>" onchange="previewImage(this,<?=$i?>)">

                        <div class="overlay">
                            <image id="imagebg<?=$i?>" class="opacity-image" src="./img/addimg.png" style="width: 50%; height: 50%;"></image>
                        </div>


                    </div>
                    <div id="delbt<?=$i?>" style="display: none;" onclick="resetImage(this.parentNode)"> <span class="delbt px-3 py-1" > ยกเลิก </span> </div>
                    <div class="p-2"></div>
                </div>
                <?php } ?>
            </div>

    <div class="btn5 pt-3 d-flex justify-content-end" >
    <button id="NextStep">ขั้นต่อไป
        <div class="arrow-wrapper">
            <div class="arrow"></div>
        </div>
    </button>
    </div>

    </div>
</div>

<style>
        .opacity-image {
            opacity: 0.5;
        }

        .image-box {
        width: 160;
        height: 120;
        border-radius: 10px;
        border: 2px dashed #ccc;
        
        overflow: hidden;
        position: relative;
        cursor: pointer;
        }

        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delbt {
            background-color: red;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            border: '2px solid white';
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            cursor: pointer;
         
        }

        .image-box .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .image-box:hover .overlay {
            opacity: 1;
        }

        .image-box input[type="file"] {
            display: none;
        }

        @media only screen and (max-width: 820px) {
        .image-box {
            width: 160px;
            height: 120px;
        }

        @media only screen and (max-width: 767px) {
        .image-box {
            width: 135px;
            height: 101px;
        }
    }
    }
    </style>

<script>

    function browseImage(inputId) {
        document.getElementById(inputId).click();
    }

    function previewImage(input, i) {
        const imageBox = input.parentNode;
        const overlay = imageBox.querySelector('.overlay');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const thumbnail = document.createElement('img');
                thumbnail.src = e.target.result;
                thumbnail.classList.add('thumbnail');

                // Remove existing thumbnail if present
                const existingThumbnail = imageBox.querySelector('.thumbnail');
                if (existingThumbnail) {
                    imageBox.removeChild(existingThumbnail);
                }

                // Add the new thumbnail to the image box
                imageBox.appendChild(thumbnail);

                // Display the "delbt" button
                console.log("SET delbt"+i);
                const delbt = document.getElementById('delbt' + i);
                delbt.style.display = 'block';

                // Hide the overlay
                overlay.style.opacity = 0;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetImage(imageBox) {
        const input = imageBox.querySelector('input[type="file"]');
        const thumbnail = imageBox.querySelector('.thumbnail');
        const overlay = imageBox.querySelector('.overlay');

        if (input) {
            input.value = ''; // Reset the file input
        }

        if (thumbnail) {
            // Check if the thumbnail is a child of the image box
            if (thumbnail.parentNode === imageBox) {
                imageBox.removeChild(thumbnail); // Remove the thumbnail
            }
        }

        // Show the overlay
        overlay.style.opacity = 1;
    }

</script>