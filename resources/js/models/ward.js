import base from "./base.js";

export default class ward extends base {
    constructor() {
        super(route('wards.index'));
        this.name = '';
        this.center_id = '';
        this.center = null;
        this.is_available = 0;
        this.listHrefId = "ward-list";
        this.createHrefId = "ward-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.center_id = this.center ? this.center.id : '';
    }

    clearData() {
        super.clearData()
        this.is_available = 0;
        this.center_id = '';
        this.center = null;
        this.name = '';
    }

    centerSelected($event) {
        this.center = $event;
        this.center_id = ($event != null) ? $event.id : "";
    }

    updateWard() {
        var url = route('wards.update', this.id);
        var data = { name: this.name, is_available: this.is_available, center_id: this.center_id, _method: "PUT" };
        super.update(url, data)
    }

    saveWard() {
        var data = { name: this.name, is_available: this.is_available, center_id: this.center_id };
        var url = route('wards.store');
        super.save(url, data);
    }

    deleteWard(id, index) {
        var url = route('wards.destroy', id);
        super.delete(url, index)
    }

}