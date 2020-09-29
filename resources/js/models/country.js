import base from "./base.js";

export default class country extends base {
    constructor(){
        super("/backend/countries");
        this.name = '';
        this.is_available = 0;
        this.listHrefId = "country-list";
        this.createHrefId = "country-list-create";
    }
    
    editRecord(index) {
        super.edit(index);        
    }

    clearData() {
        super.clearData()
        this.is_available = 0;
        this.name = '';
    }

    updateCountry() {
        var url = "/backend/countries/" + this.id;
        var data = {name:this.name, is_available:this.is_available, _method:"PUT"};
        super.update(url, data)
    }

    saveCountry() {
        var data = {name:this.name, is_available:this.is_available};
        var url = "/backend/countries/";
        super.save(url, data);
    }

    deleteCountry(id, index) {
        var url = '/backend/countries/' + id;
        super.delete(url, index)
    }

}