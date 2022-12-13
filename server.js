const WebSocket = require('ws');
const PORT = process.env.PORT || 3000;
const server = new WebSocket.Server({port:PORT});
console.log('Сервер работает, уебан')
server.on('connection',ws =>{
  ws.on('message', message => {
    server.clients.forEach(client => {
      if(client.readyState === WebSocket.OPEN){
        client.send(JSON.stringify(message));
      }
    });
  });
  ws.send(JSON.stringify('Добро пожаловать'));
});
