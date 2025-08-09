document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let locations = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
   // Función para cargar elementos desde la API
   const loadItems = () => {
      const language = document.getElementById('language-selector').value;
      fetch(`https://api.api-onepiece.com/v2/locates/${language}?offset=${offset}&limit=${limit}`)
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
                  throw new Error('Datos de localizacion son vacíos o inválidos');
              }
  
              // Actualizar la lista de personajes
              locations = data;
  
              // Mostrar los personajes
              mostrarLocalizaciones();
          })
          .catch(error => console.error('Error fetching data:', error.message));
  };
  
  
    // Función para mostrar los personajes
    const mostrarLocalizaciones = () => {
        container.innerHTML = ''; // Limpiar el contenedor
  
        locations.forEach(location => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${location.name}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `localizacion.html?id=${location.id}`;
            });
        });
    };
    
  
    // Función para buscar por nombre o numero
    window.buscarlugares = () => {
        const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();
    
        // Filtrar episodios basados en la búsqueda del usuario
        const resultados = locations.filter(localizacion => {
            // Verificar si el título o el número de la API coinciden con el término de búsqueda
            return localizacion.name.toLowerCase().includes(searchTerm);
        });
    
        // Mostrar los resultados de la búsqueda
        container.innerHTML = ''; // Limpiar el contenedor
    
        resultados.forEach(location => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${location.name}`; 
            container.appendChild(box);
    
            box.addEventListener('click', () => {
                window.location.href = `localizacion.html?id=${location.id}`;
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