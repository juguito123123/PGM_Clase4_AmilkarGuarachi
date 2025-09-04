document.getElementById('generar').addEventListener('click', () => {
  const limite = parseInt(document.getElementById('limite').value, 10);
  const salida = document.getElementById('salida');
  salida.textContent = 'Generando...';

  // Inicia el worker
  let worker;
  try {
    worker = new Worker('worker.js');
  } catch (err) {
    salida.textContent = 'Error al crear el worker: ' + err.message;
    return;
  }

  let recibido = false;
  worker.postMessage(limite);

  worker.onmessage = function(e) {
    recibido = true;
    const serie = e.data;
    salida.textContent = '';
    // Animación: muestra cada número con retraso
    let i = 0;
    function mostrarNumero() {
      if (i < serie.length) {
        salida.textContent += serie[i] + ' ';
        i++;
        setTimeout(mostrarNumero, 100); // 100ms entre cada número
      }
    }
    mostrarNumero();
    worker.terminate();
  };

  worker.onerror = function(e) {
    salida.textContent = 'Error en el worker: ' + e.message;
    worker.terminate();
  };

  setTimeout(() => {
    if (!recibido) {
      salida.textContent = 'El worker no respondió. Verifica la ruta y el nombre del archivo worker.js.';
      worker.terminate();
    }
  }, 2000);
});
