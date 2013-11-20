/* 
 * cart_model.js
 * 
 * For central model, communicate between front-end and back-end
 * 
 */

function Cart(){
    this.item = new Array();
    this.shippingCost = 0;
    this.totalCost = 0;
}

function Item(name, price, weight){
    this.name = name;
    this.price = price;
    this.weight = weight;
}