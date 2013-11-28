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
    
    this.update = update_item;
    this.remove = remove_item;
    
    function update_item(i, j){
        this.item[i].qty = j;
    }
    function remove_item(i){
        this.item.splice(i, 1);
    }
}

function Item(id, name, price, weight){
    this.id = id;
    this.name = name;
    this.price = price;
    this.weight = weight;
    this.qty;
}