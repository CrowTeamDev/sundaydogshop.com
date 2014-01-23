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
    
    this.rateShipping = 100;
    
    this.update = update_item;
    this.remove = remove_item;
    this.addShippingCost = add_shippingCost;
    
    function update_item(i, j){
        this.item[i].qty = j;
    }
    function remove_item(i){
        this.item.splice(i, 1);
    }
    function add_shippingCost(value){
        this.shippingCost = this.rateShipping * value;
        this.totalCost += this.shippingCost;
    }
}

function Item(id, name, price, weight){
    this.id = id;
    this.name = name;
    this.price = price;
    this.weight = weight;
    this.qty = 1;
}
function Item(id, name, price, weight, qty){
    this.id = id;
    this.name = name;
    this.price = price;
    this.weight = weight;
    this.qty = qty;
}

function Buyyer(){
    this.first = "";
    this.last = "";
    this.address = "";
    this.zip = "";
    this.city = "";
    this.state = "";
    this.country = "";
    this.phone = "";
    this.mobile = "";
    this.mail = "";
    
    this.getAddress = get_address;
    
    function get_address(){
        var result = 
                    this.address + ', ' +
                    this.city + ', ' +
                    this.state + ' ' +
                    this.country + ' ' +
                    this.zip;
        return result;
    }
}

