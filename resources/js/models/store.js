import base from "./base.js";

export default class store extends base {
    constructor(){
        super(route('stores.index'));
        this.name = '';
        this.store_number = '';
        this.office_id = '';
        this.office = null;
        this.listHrefId = "store-list";
        this.createHrefId = "store-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.office_id = this.office ? this.office.id :'';
    }

    clearData() {
        super.clearData()
        this.office_id = '';
        this.office = null;
        this.name = '';
        this.store_number = '';
        
    }

    officeSelected($event) {
        this.office = $event;
        this.office_id = ($event != null) ? $event.id : "";
    }

    updateStore() {
        var url = route('stores.update', this.uuid);
        var data = {
            name:this.name,
            store_number:this.store_number,
            office_id:this.office_id,
            _method:"PUT"
        };
        super.update(url, data)
    }

    saveStore() {
        var data = {
            name:this.name,
            store_number:this.store_number,
            office_id:this.office_id,
        };
        var url = route('stores.store');
        super.save(url, data);
    }

    deleteStore(id, index) {
        var url = route('stores.destroy', id);
        super.delete(url, index)
    }

}