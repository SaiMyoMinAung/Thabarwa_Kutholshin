import base from "./base.js";

export default class office extends base {
    constructor(){
        super(route('offices.index'));
        this.name = '';
        this.address = '';
        this.state_region_id = '';
        this.stateRegion = null;
        this.is_open = 0;
        this.listHrefId = "office-list";
        this.createHrefId = "office-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.state_region_id = this.stateRegion ? this.stateRegion.id :'';
    }

    clearData() {
        super.clearData()
        this.is_open = 0;
        this.state_region_id = '';
        this.stateRegion = null;
        this.name = '';
        this.address = '';
    }

    stateRegionSelected($event) {
        this.stateRegion = $event;
        this.state_region_id = ($event != null) ? $event.id : "";
    }

    updateOffice() {
        var url = route('offices.update', this.uuid);
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            state_region_id:this.state_region_id,
            _method:"PUT"
        };
        super.update(url, data)
    }

    saveOffice() {
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            state_region_id:this.state_region_id,
        };
        var url = route('offices.store');
        super.save(url, data);
    }

    deleteOffice(id, index) {
        var url = route('offices.destroy', id);
        super.delete(url, index)
    }

}