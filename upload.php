<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Upload</title>
    <style>
.dropzone {
    width: 100%;
    height: 200px;
    border: 1px dashed #000;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-image: linear-gradient(to right, #7affe7, #53a8ff);
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    color: black;
    text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
}


.thumbnail {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    margin: 15px;
}
    </style>
</head>
<body>
    <div class="dropzone" id="dropzone">Drag & drop files here or click to select</div>
    <div id="thumbnails"></div>
    <button id="uploadBtn">Upload</button>
    <script src="upload.js"></script>
</body>
</html>
