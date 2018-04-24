const http = require('http');
const fs = require('fs');
const mysql = require('mysql');
const io = require('socket.io');
const url = require('url');

// 数据库
let db = mysql.createPool({host: 'localhost', user: 'root', password: '123456', database: 'websocket'});

// 1、http服务器
let httpServer = http.createServer((req, res)=>{
	let {pathname, query} = url.parse(req.url, true);

	if (pathname == '/reg') {
		let {user, pass} = query;
		// 校验数据
		if (!/^\w{6,32}$/.test(user)) {
			res.write(JSON.stringify({code: 1, msg: '用户名不符合规范'}));
			res.end();
		} else if (!/^.{6,32}$/.test(pass)) {
			res.write(JSON.stringify({code: 1, msg: '密码不符合规范'}));
			res.end();
		} else {
			// 检验用户名是否重复
			db.query(`SELECT * FROM tb1 WHERE username='${user}'`, (err, data)=>{
				if (err) {
					res.write(JSON.stringify({code: 1, msg: '数据库有错'}));
					res.end();
				} else if (data.length > 0) {
					res.write(JSON.stringify({code: 1, msg: '此用户名已存在'}));
					res.end();
				} else {
					// 插入数据
					db.query(`INSERT INTO tb1(username, password, online) VALUES('${user}', '${pass}', 0)`, err=>{
						if (err) {
							res.write(JSON.stringify({code: 1, msg: '数据库有错'}));
							res.end();
						} else {
							res.write(JSON.stringify({code: 0, msg: '注册成功'}));
							res.end();
						}
					})
				}
			});
		}
	} else if (pathname == '/login') {
		console.log('请求了登录接口');
	} else {
		fs.readFile(`www${req.url}`, (err, data)=>{
			if (err) {
				res.writeHead(404);
				res.write('Not Found');
			} else {
				res.write(data);
			}
			res.end();
		});
	}
});

const port = 8080;
httpServer.listen(port, ()=>{
	console.log(`正在监听${port}端口`);
});