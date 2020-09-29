import base from "./base.js";

export default class city extends base {
    constructor(){
        super("/backend/cities");
        this.name = '';
        this.is_available = 0;
        this.listHrefId = "city-list";
        this.createHrefId = "city-list-create";
    }
    
    editRecord(index) {
        super.edit(index);        
    }

    clearData() {
        super.clearData()
        this.is_available = 0;
        this.name = '';
    }

    updateCity() {
        var url = "/backend/cities/" + this.id;
        var data = {name:this.name,is_available:this.is_available,_method:"PUT"};
        super.update(url, data)
    }

    saveCity() {
        var data = {name:this.name,is_available:this.is_available};
        var url = "/backend/cities/";
        super.save(url, data);
    }

    deleteCity(id, index) {
        var url = '/backend/cities/' + id;
        super.delete(url, index)
    }

}