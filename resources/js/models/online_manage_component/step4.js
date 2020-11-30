import step4Validation from '../../validations/online_manage_component/step4'

export default class step4 {
    constructor(uuid = '') {
        this.uuid = uuid
        this.validation = new step4Validation;
    }

    goToMakeRequest() {
        window.location.href = route('donated_items.requested_items.index', this.uuid)
    }

    assignComplete() {
        let self = this;
        let assignCompleteApi = route("donatedItem.assignComplete", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .get(assignCompleteApi)
            .then((response) => {
                console.log(response)
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step4Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step4Validation(error.response.data.errors);
            });
    }

    assignIncomplete() {
        let self = this;
        let assignIncompleteApi = route("donatedItem.assignIncomplete", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .get(assignIncompleteApi)
            .then((response) => {
                console.log(response)
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step4Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step4Validation(error.response.data.errors);
            });
    }


    constructData(model) {
        this.uuid = model.uuid
        this.is_complete = model.is_complete
    }

}