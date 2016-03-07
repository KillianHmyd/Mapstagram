/**
 * Created by Killian on 25/02/2016.
 */
var express    = require('express');
var app        = express();
var bodyParser = require('body-parser');
var port = process.env.PORT || 8282;
var router = express.Router();
var twig = require('twig');
var multipart = require('multipart');

var user = require('./routes/user.js');
var photo = require('./routes/photo.js');
var friend = require('./routes/friend.js');
var multer = require('multer');

var userModel = require('./models/user.js');

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(multer({dest:'./views/img/'}).single('photo'));


app.set('view engine', 'html');
app.engine('html', twig.__express);

var path = '/api';

router.use(function(req, res, next){
    res.setHeader("Content-Type", "text/json");
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, " +
        "Accept, X-Auth-Token, token");
    console.log(req.method + " - " +req.url)
    if(req.url == "/authenticate" || (req.url == "/user" && req.method == "POST")
        || (/^\/photo\/.+/.test(req.url))){
        next();
    }
    else if(!req.headers.token){
        res.json({error : 401, message : "No given Auth-Key"});
    }
    else{
        userModel.getUserFromToken(req.headers.token, function(err, rows){
            if(err)
                res.json(err);
            else {
                req.user = rows;
                next();
            }
        })
    }
})

router.get('/', function(req, res) {

});

user.route(router);
photo.route(router);
friend.route(router);

app.use(path, router);

app.listen(port);

console.log("Serveur lancé sur le port " + port)