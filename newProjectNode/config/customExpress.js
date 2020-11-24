const { Console } = require('console')
const consign = required('consign')
const express = require('express')

module.exports=() => {
    const app = express()
    consign()
     .include('controllers')
     .into(app)

     return app
}


