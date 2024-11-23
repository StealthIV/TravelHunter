const panorama = new PANOLENS.ImagePanorama('../img/shang.jpg');
    const panorama2 = new PANOLENS.ImagePanorama('../img/boracayfinal3.jpg');
    let imageContainer = document.querySelector('.image-container');
    let placeName = document.getElementById('place-name');

    var infospotPositions = [
        new THREE.Vector3(-2136.06, 16.30, 890.14),
        new THREE.Vector3(-3136.06, 296.30, -4290.14),
    ];

    const viewer = new PANOLENS.Viewer({
        container: imageContainer,
        autoRotate: true,
        autoRotateSpeed: 0.3,
        controlBar: true,
    });

    // Update the place name dynamically
    panorama.addEventListener('enter', () => {
        placeName.textContent = 'Shangri-La Hotel';
    });

    panorama2.addEventListener('enter', () => {
        placeName.textContent = 'Boracay Beach';
    });

    // Link panoramas
    panorama.link(panorama2, infospotPositions[0]);
    panorama2.link(panorama, infospotPositions[1]);

    // Add panoramas to the viewer
    viewer.add(panorama, panorama2);