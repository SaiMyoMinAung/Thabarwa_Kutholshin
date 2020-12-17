import base from "./base.js";

export default class office extends base {
    constructor(){
        super(route('offices.index'));
        this.name = '';
        this.address = '';
        this.center_id = '';
        this.center = null;
        this.is_open = 0;
        this.listHrefId = "office-list";
        this.createHrefId = "office-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.center_id = this.center ? this.center.id :'';
    }

    clearData() {
        super.clearData()
        this.is_open = 0;
        this.center_id = '';
        this.center = null;
        this.name = '';
        this.address = '';
    }

    centerSelected($event) {
        this.center = $event;
        this.center_id = ($event != null) ? $event.id : "";
    }

    updateOffice() {
        var url = route('offices.update', this.uuid);
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            center_id:this.center_id,
            _method:"PUT"
        };
        super.update(url, data)
    }

    saveOffice() {
        var data = {
            name:this.name,
            address:this.address,
            is_open:this.is_open,
            center_id:this.center_id,
        };
        var url = route('offices.store');
        super.save(url, data);
    }

    deleteOffice(id, index) {
        var url = route('offices.destroy', id);
        super.delete(url, index)
    }

}