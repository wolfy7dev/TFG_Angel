document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let episodes = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
   // Función para cargar elementos desde la API
   const loadItems = () => {
      const language = document.getElementById('language-selector').value;
      fetch(`https://api.api-onepiece.com/v2/episodes/${language}?offset=${offset}&limit=${limit}`)
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
              episodes = data;
  
              // Mostrar los personajes
              mostrarEpisodios();
          })
          .catch(error => console.error('Error fetching data:', error.message));
  };
  
  
    // Función para mostrar los personajes
    const mostrarEpisodios = () => {
        container.innerHTML = ''; // Limpiar el contenedor
  
        episodes.forEach(episode => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `Chapter ${episode.number}: ${episode.title}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `episodio.html?id=${episode.id}`;
            });
        });
    };
    
  
    // Función para buscar por nombre o numero
    window.buscarEpisodio = () => {
        const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();
    
        // Filtrar episodios basados en la búsqueda del usuario
        const resultados = episodes.filter(serie => {
            // Verificar si el título o el número de la API coinciden con el término de búsqueda
            return serie.title.toLowerCase().includes(searchTerm) || serie.number.toString().includes(searchTerm);
        });
    
        // Mostrar los resultados de la búsqueda
        container.innerHTML = ''; // Limpiar el contenedor
    
        resultados.forEach(episode => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `Chapter ${episode.number}: ${episode.title}`; // Mostrar título y número de la API
            container.appendChild(box);
    
            box.addEventListener('click', () => {
                window.location.href = `episodio.html?id=${episode.id}`;
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