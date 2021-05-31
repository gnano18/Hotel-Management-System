/**
 * SERVER SAMPLE PER T TESTU A DERGOHEN REQUESTAT; kjo do zevndsohet me filet php.
 */

const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors());

app.use('/login',(req,res)=>{
    res.send({token: "token123"});

});

app.listen(8080, () => console.log('API is running on http://localhost:8080/login'));