/* 
 * cart_model.js
 * 
 * For central model, communicate between front-end and back-end
 * 
 */

function Cart(){
    this.item = new Array();
    this.totalCost = 0;
    this.toalWeight = 0;
    this.shippingRate = 1;
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

