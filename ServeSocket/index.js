const io = require('socket.io')(2306);
io.on('connection', (socket) => {
    socket.on('Khách hàng gửi tin nhắn',(data)=>{
        console.log(data);
        io.emit('Khách hàng đã gửi tin nhắn', data);
    });
    socket.on('Admin gửi tin nhắn',(data)=>{
        console.log(data);
        io.emit('Admin đã gửi tin nhắn', data);
    });


    // console.log(socket.id);
})