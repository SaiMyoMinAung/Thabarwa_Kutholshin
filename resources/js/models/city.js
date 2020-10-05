import base from "./base.js";

export default class city extends base {
    constructor(){
        super(route('cities.index'));
        this.name = '';
        this.state_region_id = '';
        this.stateRegion = null;
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
        this.state_region_id = '';
        this.stateRegion = null;
        this.name = '';
    }

    stateRegionSelected($event) {
        this.stateRegion = $event;
        this.state_region_id = ($event != null) ? $event.id : "";
    }

    updateCity() {
        var url = route('cities.update', this.id);
        var data = {name:this.name,is_available:this.is_available,state_region_id:this.state_region_id,_method:"PUT"};
        super.update(url, data)
    }

    saveCity() {
        var data = {name:this.name,is_available:this.is_available,state_region_id:this.state_region_id};
        var url = route('cities.store');
        super.save(url, data);
    }

    deleteCity(id, index) {
        var url = route('cities.destroy', id);
        super.delete(url, index)
    }

}