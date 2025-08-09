document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let chapters = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
   // Función para cargar elementos desde la API
   const loadItems = () => {
      const language = document.getElementById('language-selector').value;
      fetch(`https://api.api-onepiece.com/v2/chapters/${language}?offset=${offset}&limit=${limit}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error en la petición a la API');
              }
              return response.json();
          })
          .then(data => {
              console.log('Datos recibidos:', data);
  
              // Verificar si se recibieron datos válidos
              if (!data || !data.length) {
                  throw new Error('Datos de personajes vacíos o inválidos');
              }
  
              // Actualizar la lista de personajes
              chapters = data;
  
              // Mostrar los personajes
              mostrarCapitulos();
          })
          .catch(error => console.error('Error fetching data:', error.message));
  };
  
  
    // Función para mostrar los personajes
    const mostrarCapitulos = () => {
        container.innerHTML = ''; // Limpiar el contenedor
  
        chapters.forEach(chapter => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${chapter.title}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `capitulo.html?id=${chapter.id}`;
            });
        });
    };
    
  
    // Función para buscar personajes
    window.buscarCapitulo = () => {
        const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();
  
        // Filtrar personajes basados en la búsqueda del usuario
        const resultados = chapters.filter(capitulo => {
            return capitulo.name.toLowerCase().includes(searchTerm);
        });
  
        // Mostrar los resultados de la búsqueda
        container.innerHTML = ''; // Limpiar el contenedor
  
        resultados.forEach(chapter => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${chapter.title}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `capitulo.html?id=${chapter.id}`;
            });
        });
    };
  // Evento de cambio en el selector de idioma
  document.getElementById('language-selector').addEventListener('change', () => {
      loadItems();
  });
    // Cargar los primeros elementos al cargar la página
    loadItems();
  });