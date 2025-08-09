document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let boats = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
   // Función para cargar elementos desde la API
   const loadItems = () => {
      const language = document.getElementById('language-selector').value;
      fetch(`https://api.api-onepiece.com/v2/boats/${language}?offset=${offset}&limit=${limit}`)
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
              boats = data;
  
              // Mostrar los personajes
              mostrarBarcos();
          })
          .catch(error => console.error('Error fetching data:', error.message));
  };
  
  
    // Función para mostrar los personajes
    const mostrarBarcos = () => {
        container.innerHTML = ''; // Limpiar el contenedor
  
        boats.forEach(boat => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${boat.name}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `barco.html?id=${boat.id}`;
            });
        });
    };
    
  
    // Función para buscar personajes
    window.buscarBarco = () => {
        const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();
  
        // Filtrar personajes basados en la búsqueda del usuario
        const resultados = boats.filter(barco => {
            return barco.name.toLowerCase().includes(searchTerm);
        });
  
        // Mostrar los resultados de la búsqueda
        container.innerHTML = ''; // Limpiar el contenedor
  
        resultados.forEach(boat => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${boat.name}`;
            container.appendChild(box);
  
            box.addEventListener('click', () => {
                window.location.href = `barco.html?id=${boat.id}`;
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