document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let crews = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
   // Función para cargar elementos desde la API
   const loadItems = () => {
      const language = document.getElementById('language-selector').value;
      fetch(`https://api.api-onepiece.com/v2/crews/${language}?offset=${offset}&limit=${limit}`)
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
                  throw new Error('Datos de crew vacíos o inválidos');
              }
  
              // Actualizar la lista de personajes
              crews = data;
  
              // Mostrar las bandas piratas
              mostrarBandas();
          })
          .catch(error => console.error('Error fetching data:', error.message));
  };
  
  
    // Función para mostrar los personajes
    const mostrarBandas = () => {
        container.innerHTML = ''; // Limpiar el contenedor
  
        crews.forEach(crew => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${crew.name}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `crew.html?id=${crew.id}`;
            });
        });
    };
    
  
    // Función para buscar crews
    window.buscarBanda = () => {
        const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();
  
        // Filtrar personajes basados en la búsqueda del usuario
        const resultados = crews.filter(bandas => {
            return bandas.name.toLowerCase().includes(searchTerm);
        });
  
        // Mostrar los resultados de la búsqueda
        container.innerHTML = ''; // Limpiar el contenedor
  
        resultados.forEach(crew => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${crew.name}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `crew.html?id=${crew.id}`;
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