// Array de imágenes disponibles
const imagenes = ['img/fondo1.jpg', 'img/fondo2.webp', 'img/fondo3.webp','img/fondo4.jpg', 
'img/fondo5.jpg', 'img/fondo6.jpg', 'img/fondo7.jpg', 'img/fondo8.jpg', 'img/fondo9.jpg', 
'img/fondo10.webp', 'img/fondo11.webp', 'img/fondo12.jpg', 'img/fondo13.webp', 'img/fondo14.jpg', 
'img/fondo15.jpg', 'img/fondo16.jpg', 'img/fondo18.png', 'img/fondo17.webp', 'img/fondo19.jpeg', 
'img/fondo20.png', 'img/fondo21.png', 'img/fondo22.png', 'img/fondo23.png', 'img/fondo24.png',
'img/fondo25.png', 'img/fondo26.jpg', 'img/fondo27.jpg'];

// Seleccionar una imagen aleatoria
const imagenAleatoria = imagenes[Math.floor(Math.random() * imagenes.length)];

// Establecer la imagen como fondo del cuerpo
document.body.style.backgroundImage = `url('${imagenAleatoria}')`;