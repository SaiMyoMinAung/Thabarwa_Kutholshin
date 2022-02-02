<template>
    <div>
        <!-- Button trigger modal -->
        <!-- <button
            type="button"
            class="btn btn-info"
            data-toggle="modal"
            data-target="#teamModel"
        >
            {{ trans.get("button.create_team") }}
        </button> -->
        <add-center-component />
        <!-- Modal -->
        <div
            class="modal fade"
            id="teamModel"
            tabindex="-1"
            role="dialog"
            aria-labelledby="teamLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="teamLabel">
                            {{ trans.get("button.create_team") }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="team_name"
                                >{{ trans.get("input.name") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="team_name"
                                :placeholder="
                                    trans.get('input.name_placeholder')
                                "
                                v-model="data.name"
                                v-bind:class="{
                                    'is-invalid': validation.name_hasError,
                                    'is-valid':
                                        submited && !validation.name_hasError
                                }"
                            />

                            <div
                                class="invalid-feedback"
                                v-if="validation.name_hasError"
                            >
                                {{ validation.name_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.name_hasError && submited"
                            >
                                {{ validation.name_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="team_email">{{
                                trans.get("input.email")
                            }}</label>
                            <input
                                type="email"
                                class="form-control"
                                id="team_email"
                                :placeholder="
                                    trans.get('input.email_placeholder')
                                "
                                v-model="data.email"
                                v-bind:class="{
                                    'is-invalid': validation.email_hasError,
                                    'is-valid':
                                        submited && !validation.email_hasError
                                }"
                            />

                            <div
                                class="invalid-feedback"
                                v-if="validation.email_hasError"
                            >
                                {{ validation.email_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.email_hasError && submited"
                            >
                                {{ validation.email_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="team_phone"
                                >{{ trans.get("input.phone") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control only-number"
                                id="team_phone"
                                :placeholder="
                                    trans.get('input.phone_placeholder')
                                "
                                v-model="data.phone"
                                v-bind:class="{
                                    'is-invalid': validation.phone_hasError,
                                    'is-valid':
                                        submited && !validation.phone_hasError
                                }"
                            />

                            <div
                                class="invalid-feedback"
                                v-if="validation.phone_hasError"
                            >
                                {{ validation.phone_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.phone_hasError && submited"
                            >
                                {{ validation.phone_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <button
                                type="button"
                                class="btn btn-sm btn-info"
                                data-toggle="modal"
                                data-target="#centerModel"
                            >
                                +
                            </button>

                            <label for="center"
                                >{{ trans.get("input.select_center") }}
                                <span class="text-danger">*</span></label
                            >
                            <select2
                                :url="fetchCenter"
                                placeholder="Select Center"
                                :value="null"
                                @input="selectedCenterBox($event)"
                                :selected-option="selectedCenter"
                                v-bind:class="{
                                    'is-invalid': validation.center_id_hasError,
                                    'is-valid':
                                        submited &&
                                        !validation.center_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.center_id_hasError"
                            >
                                {{ validation.center_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="
                                    !validation.center_id_hasError && submited
                                "
                            >
                                {{ validation.center_id_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans.get("input.note") }}</label>
                            <textarea
                                name="note"
                                class="form-control"
                                rows="3"
                                :placeholder="
                                    trans.get('input.note_placeholder')
                                "
                                v-model="data.note"
                                v-bind:class="{
                                    'is-invalid': validation.note_hasError,
                                    'is-valid':
                                        submited && !validation.note_hasError
                                }"
                            ></textarea>

                            <div
                                class="invalid-feedback"
                                v-if="validation.note_hasError"
                            >
                                {{ validation.note_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.note_hasError && submited"
                            >
                                {{ validation.note_successMessage }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="create()"
                        >
                            {{ trans.get("button.create") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            id="teamModelClose"
                        >
                            {{ trans.get("button.close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddCenterComponent from "./AddCenterComponent.vue";
import select2 from "./select2";
export default {
    components: {
        select2,
        AddCenterComponent
    },
    data: function() {
        return {
            data: {
                name: "",
                email: "",
                phone: "",
                note: "",
                center_id: ""
            },
            submited: false,
            fetchCenter: route("centers.fetch"),
            selectedCenter: {},
            validation: {
                name_hasError: false,
                name_errorMessage: "",
                name_successMessage: "",

                email_hasError: false,
                email_errorMessage: "",
                email_successMessage: "",

                phone_hasError: false,
                phone_errorMessage: "",
                phone_successMessage: "",

                note_hasError: false,
                note_errorMessage: "",
                note_successMessage: ""
            }
        };
    },
    mounted() {
        let url = route("auth.admin.information");
        $.get(url)
            .then(response => {
                this.data.center_id = response.center.id;
            })
            .catch(error => {
                console.log(error);
            });
    },
    created() {
        this.$root.$on("centerSuccess", data => {
            this.data.center_id = data.id;
            this.selectedCenter = data;
        });
    },
    methods: {
        create() {
            this.submited = true;
            let self = this;
            let url = route("teams.store");

            window.dashboard_app.$emit("startLoading");

            axios
                .post(url, this.data)
                .then(response => {
                    this.clearValidation();
                    this.clearData();

                    window.dashboard_app.$emit("teamCreateSuccess", response.data);
                    window.dashboard_app.$toasted.show("Saving Success.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                    document.getElementById('teamModelClose').click();
                })
                .catch(function(error) {
                    // window.dashboard_app.$emit('failed')
                    console.log(error.response);
                    self.clearValidation();
                    self.constructValidation(error.response.data.errors);

                    window.dashboard_app.$toasted.show("Saving Failed.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                });
        },
        selectedCenterBox(event) {
            this.selectedCenter = event;
            this.data.center_id = event != null ? event.id : "";
        },
        clearValidation() {
            this.validation.name_hasError = false;
            this.validation.name_errorMessage = "";
            this.validation.name_successMessage = "";

            this.validation.email_hasError = false;
            this.validation.email_errorMessage = "";
            this.validation.email_successMessage = "";

            this.validation.phone_hasError = false;
            this.validation.phone_errorMessage = "";
            this.validation.phone_successMessage = "";

            this.validation.note_hasError = false;
            this.validation.note_errorMessage = "";
            this.validation.note_successMessage = "";

            this.validation.center_id_hasError = false;
            this.validation.center_id_errorMessage = "";
            this.validation.center_id_successMessage = "";
        },
        constructValidation(validation) {
            if (validation.name) {
                this.validation.name_hasError = true;
                this.validation.name_errorMessage = validation.name[0];
            } else {
                this.validation.name_successMessage = "Good Job";
            }
            if (validation.email) {
                this.validation.email_hasError = true;
                this.validation.email_errorMessage = validation.email[0];
            } else {
                this.validation.email_successMessage = "Good Job";
            }
            if (validation.phone) {
                this.validation.phone_hasError = true;
                this.validation.phone_errorMessage = validation.phone[0];
            } else {
                this.validation.phone_successMessage = "Good Job";
            }
            if (validation.note) {
                this.validation.note_hasError = true;
                this.validation.note_errorMessage = validation.note[0];
            } else {
                this.validation.note_successMessage = "Good Job";
            }
            if (validation.center_id) {
                this.validation.center_id_hasError = true;
                this.validation.center_id_errorMessage =
                    validation.center_id[0];
            } else {
                this.validation.center_id_successMessage = "Good Job";
            }
        },
        clearData() {
            this.data.name = "";
            this.data.email = "";
            this.data.phone = "";
            this.data.note = "";
            this.data.center_id = "";
            this.selectedCenter = {};
            this.submited = false;
        }
    }
};
</script>
