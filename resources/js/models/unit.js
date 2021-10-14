import base from "./base.js";

export default class Unit extends base {
    constructor() {
        super(route('units.index'));
        this.package_unit = '';
        this.package_symbol = '';
        this.loose_unit = '';
        this.loose_symbol = '';
        this.listHrefId = "unit-list";
        this.createHrefId = "unit-list-create";
    }

    editRecord(index) {
        super.edit(index);
    }

    clearData() {
        super.clearData()
        this.package_unit = '';
        this.package_symbol = '';
        this.loose_unit = '';
        this.loose_symbol = '';
    }

    updateUnit() {
        var url = route('units.update', this.id);
        var data = {
            package_unit: this.package_unit,
            package_symbol: this.package_symbol,
            loose_unit: this.loose_unit,
            loose_symbol: this.loose_symbol,
            _method: "PUT"
        };
        super.update(url, data)
    }

    saveUnit() {
        var data = {
            package_unit: this.package_unit,
            package_symbol: this.package_symbol,
            loose_unit: this.loose_unit,
            loose_symbol: this.loose_symbol
        };
        var url = route('units.store');
        super.save(url, data);
    }

    deleteUnit(id, index) {
        var url = route('units.destroy', id);
        super.delete(url, index)
    }

}