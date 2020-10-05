import base from "./base.js";

export default class StateRegion extends base {
    constructor(){
        super(route('state_regions.index'));
        this.name = '';
        this.code = '';
        this.is_available = 0;
        this.country_id = '';
        this.country = null;
        this.listHrefId = "state-region-list";
        this.createHrefId = "state-region-list-create";
    }
    
    editRecord(index) {
        super.edit(index);
        this.country_id = this.country ? this.country.id: '';
    }

    clearData() {
        super.clearData()
        this.is_available = 0;
        this.country_id = null;
        this.country = null;
        this.code = '';
        this.name = '';
    }

    countrySelected($event) {
        console.log($event)
        this.country = $event;
        this.country_id = ($event != null) ? $event.id : "";
    }

    updateStateRegion() {
        var url = route('state_regions.update', this.id);
        var data = {name:this.name, is_available:this.is_available, code: this.code, country_id: this.country_id, _method:"PUT"};
        super.update(url, data)
    }

    saveStateRegion() {
        var data = {name:this.name, is_available:this.is_available, code:this.code, country_id:this.country_id};
        var url = route('state_regions.store');
        super.save(url, data);
    }

    deleteStateRegion(id, index) {
        var url = route('state_regions.destroy', id);
        super.delete(url, index)
    }

}