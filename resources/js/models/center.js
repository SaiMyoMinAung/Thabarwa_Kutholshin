import base from "./base.js";

export default class center extends base {
    constructor() {
        super(route('centers.index'));
        this.name = '';
        this.city_id = '';
        this.city = null;
        this.is_available = 0;
        this.listHrefId = "center-list";
        this.createHrefId = "center-list-create";
    }

    editRecord(index) {
        super.edit(index);
        this.city_id = this.city ? this.city.id : '';
    }

    clearData() {
        super.clearData()
        this.is_available = 0;
        this.city_id = '';
        this.city = null;
        this.name = '';
    }

    citySelected($event) {
        this.city = $event;
        this.city_id = ($event != null) ? $event.id : "";
    }

    updateCenter() {
        var url = route('centers.update', this.id);
        var data = { name: this.name, is_available: this.is_available, city_id: this.city_id, _method: "PUT" };
        super.update(url, data)
    }

    saveCenter() {
        var data = { name: this.name, is_available: this.is_available, city_id: this.city_id };
        var url = route('centers.store');
        super.save(url, data);
    }

    deleteCenter(id, index) {
        var url = route('centers.destroy', id);
        super.delete(url, index)
    }

}