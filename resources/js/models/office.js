import base from "./base.js";

export default class office extends base {
    constructor(){
        super(route('offices.index'));
        this.name = '';
        this.address = '';
        this.city_id = '';
        this.city = null;
        this.is_open = 0;
        this.listHrefId = "office-list";
        this.createHrefId = "office-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.city_id = this.city ? this.city.id :'';
    }

    clearData() {
        super.clearData()
        this.is_open = 0;
        this.city_id = '';
        this.city = null;
        this.name = '';
        this.address = '';
    }

    citySelected($event) {
        this.city = $event;
        this.city_id = ($event != null) ? $event.id : "";
    }

    updateOffice() {
        var url = route('offices.update', this.uuid);
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            city_id:this.city_id,
            _method:"PUT"
        };
        super.update(url, data)
    }

    saveOffice() {
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            city_id:this.city_id,
        };
        var url = route('offices.store');
        super.save(url, data);
    }

    deleteOffice(id, index) {
        var url = route('offices.destroy', id);
        super.delete(url, index)
    }

}