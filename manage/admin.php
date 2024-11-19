


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
   
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url(../img/gg.jpg);
        }
        header {
            text-align: center;
            margin-top: 40px;
            font-size: 40px;
            color: white;
            -webkit-text-stroke: 4px greenyellow;
           
           
        }
        main {
            background-color: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
           margin-right: 20px;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .preview-container {
            margin-top: 20px;
        }
        .preview-container img {
            max-width: 100%;
            max-height: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Event Calendar</h1>
    </header>
    <main>
        <form id="admin-form">
            <label for="title">Page Title:</label>
            <input type="text" id="title" name="title" required><br>
            
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br>
            
            <div class="preview-container" id="preview-container" style="display:none;">
                <p>Image Preview:</p>
                <img id="image-preview" src="" alt="Image Preview">
            </div>

            <label for="history">Content Text:</label>
            <textarea id="history" name="history" required></textarea><br>
            
            <button type="submit">Update Content</button>
        </form>
    </main>
    <script>
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        // Show a preview of the uploaded image
        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                previewContainer.style.display = 'none';
            }
        });

        // Handle form submission
        document.getElementById('admin-form').addEventListener('submit', (e) => {
            e.preventDefault();

            const title = document.getElementById('title').value;
            const image = document.getElementById('image').files[0]; // Get the file input
            const history = document.getElementById('history').value;

            // Check if an image is uploaded
            if (image) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageData = e.target.result;
                    localStorage.setItem('title', title);
                    localStorage.setItem('image', imageData); // Store image as base64
                    localStorage.setItem('history', history);

                    alert('Content updated!');
                };
                reader.readAsDataURL(image); // Convert image to base64 for localStorage
            } else {
                localStorage.setItem('title', title);
                localStorage.setItem('history', history);

                alert('Content updated!');
            }
        });
    </script>
</body>
</html>
