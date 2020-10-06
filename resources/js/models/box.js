import base from "./base.js";

export default class box extends base {
    constructor(){
        super(route('boxes.index'));
        this.name = '';
        this.box_number = '';
        this.store_id = '';
        this.store = null;
        this.listHrefId = "box-list";
        this.createHrefId = "box-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.store_id = this.store ? this.store.id :'';
    }

    clearData() {
        super.clearData()
        this.name = '';
        this.box_number = '';
        this.store_id = '';
        this.store = null;
    }

    storeSelected($event) {
        this.store = $event;
        this.store_id = ($event != null) ? $event.id : "";
    }

    updateBox() {
        var url = route('boxes.update', this.uuid);
        var data = {
            name:this.name,
            box_number:this.box_number,
            store_id:this.store_id,
            _method:"PUT"
        };
        super.update(url, data)
    }

    saveBox() {
        var data = {
            name:this.name,
            box_number:this.box_number,
            store_id:this.store_id,
        };
        var url = route('boxes.store');
        super.save(url, data);
    }

    deleteOffice(id, index) {
        var url = route('boxes.destroy', id);
        super.delete(url, index)
    }

}