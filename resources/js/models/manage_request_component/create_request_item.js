import createRequestItemValidation from './create_request_item_validation';

export default class CreateRequestItem {
    constructor() {
        this.fetchUrl = '';
        this.getTeamUrl = route('teams.fetch');
        this.getUserUrl = route('users.fetch');
        this.getYogiUrl = route('yogis.fetch');
        this.getRequestableTypeUrl = route('requestable_types.fetch');
        this.requestable = {
            id: "",
            name: ""
        };
        this.requestable_type = {
            id: "",
            name: ""
        };
        this.startFetchForRequestablePerson = 0;
        this.data = {
            qty: "",
            requestable_id: "",
            requestable_type: ""
        }
        this.validation = new createRequestItemValidation()
    }

    selectedRequestableType(event) {
        this.requestable_type = event;
        this.data.requestable_type = (event != null) ? event.id : "";
        if (event != null && event.id == 'USER') {
            this.fetchUrl = this.getUserUrl;
        }
        if (event != null && event.id == 'TEAM') {
            this.fetchUrl = this.getTeamUrl;
        }
        if (event != null && event.id == 'YOGI') {
            this.fetchUrl = this.getYogiUrl;
        }
        this.requestable = {
            id: "",
            name: ""
        }
        this.data.requestable_id = ""
        this.startFetchForRequestablePerson++
    }

    selectedRequestableId(event) {
        this.requestable = event;
        this.data.requestable_id = event != null ? event.id : "";
    }
}