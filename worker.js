self.onmessage = function(e) {
  const limite = e.data;
  const serie = [];
  for (let i = 1; i <= limite; i++) {
    serie.push(i);
  }
  self.postMessage(serie);
};
