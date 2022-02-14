<template>
    <div class="row">
        <loading
            :active.sync="isLoading"
            :can-cancel="true"
            :is-full-page="fullPage"
        ></loading>
        <div class="col-md-12 col-lg-12 row mb-1"></div>
        <div class="col-md-6 col-lg-6 ">
            <div class="border border-success" style="min-height: 550px">
                <div class="card-body row">
                    <div class="col-md-9" v-if="edit">
                        <h3>
                            <span>
                                {{
                                    InternalDonatedItemModel.data.item_unique_id
                                }}
                            </span>
                            (
                            <span
                                v-bind:class="{
                                    'badge badge-success':
                                        InternalDonatedItemModel.data
                                            .is_confirmed,
                                    'badge badge-warning': !InternalDonatedItemModel
                                        .data.is_confirmed
                                }"
                            >
                                {{
                                    InternalDonatedItemModel.data.is_confirmed
                                        ? "Confirmed"
                                        : "Unconfirmed"
                                }}
                            </span>
                            )
                        </h3>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <add-alms-round-component
                                    class="float-left"
                                    v-if="almsRoundDisabled"
                                />
                                <label for="almsRound">
                                    {{ trans.get("input.alms_round")
                                    }}<span class="text-danger">*</span>
                                </label>
                                <select2
                                    :tabindex="1"
                                    :url="
                                        InternalDonatedItemModel.fetchAlmsRound
                                    "
                                    placeholder="Select Alms Round"
                                    :value="
                                        InternalDonatedItemModel.data
                                            .alms_round_id
                                    "
                                    @input="
                                        InternalDonatedItemModel.selectedAlmsRoundBox(
                                            $event
                                        )
                                    "
                                    :selected-option="
                                        InternalDonatedItemModel.selectedAlmsRound
                                    "
                                    :disabled="disabled"
                                    v-bind:class="{
                                        'is-invalid':
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_hasError,
                                        'is-valid':
                                            InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .alms_round_id_hasError
                                    }"
                                ></select2>
                                <div
                                    class="invalid-feedback"
                                    v-if="
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .alms_round_id_hasError
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .alms_round_id_errorMessage
                                    }}
                                </div>

                                <div
                                    class="valid-feedback"
                                    v-if="
                                        !InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .alms_round_id_hasError &&
                                            InternalDonatedItemModel.InternalDonatedItemSubmited
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .alms_round_id_successMessage
                                    }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <add-item-sub-type-component
                                    class="float-left"
                                    v-if="!itemSubTypeDisabled"
                                />
                                <label for="itemSubType"
                                    >{{ trans.get("input.item_sub_type")
                                    }}<span class="text-danger">*</span></label
                                >
                                <select2
                                    :tabindex="3"
                                    :url="
                                        InternalDonatedItemModel.fetchItemSubType
                                    "
                                    placeholder="Select Item Sub Type"
                                    :value="
                                        InternalDonatedItemModel.data
                                            .item_sub_type_id
                                    "
                                    @input="
                                        InternalDonatedItemModel.selectedItemSubTypeBox(
                                            $event
                                        )
                                    "
                                    :selected-option="
                                        InternalDonatedItemModel.selectedItemSubType
                                    "
                                    :disabled="itemSubTypeDisabled"
                                    :fetch="
                                        InternalDonatedItemModel.itemSubTypeFetch
                                    "
                                    v-bind:class="{
                                        'is-invalid':
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_hasError,
                                        'is-valid':
                                            InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .item_sub_type_id_hasError
                                    }"
                                ></select2>
                                <div
                                    class="invalid-feedback"
                                    v-if="
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .item_sub_type_id_hasError
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .item_sub_type_id_errorMessage
                                    }}
                                </div>

                                <div
                                    class="valid-feedback"
                                    v-if="
                                        !InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .item_sub_type_id_hasError &&
                                            InternalDonatedItemModel.InternalDonatedItemSubmited
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .item_sub_type_id_successMessage
                                    }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="package_qty"
                                    >{{ trans.get("input.package_qty") }}
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    :tabindex="5"
                                    name="package_qty"
                                    id="package_qty"
                                    type="text"
                                    class="form-control only-number"
                                    :placeholder="
                                        trans.get(
                                            'input.package_qty_placeholder'
                                        )
                                    "
                                    v-model="
                                        InternalDonatedItemModel.data
                                            .package_qty
                                    "
                                    :disabled="disabled"
                                    v-bind:class="{
                                        'is-invalid':
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_hasError,
                                        'is-valid':
                                            InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .package_qty_hasError
                                    }"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .package_qty_hasError
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .package_qty_errorMessage
                                    }}
                                </div>

                                <div
                                    class="valid-feedback"
                                    v-if="
                                        !InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .package_qty_hasError &&
                                            InternalDonatedItemModel.InternalDonatedItemSubmited
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .package_qty_successMessage
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sacket_qty"
                                    >{{ trans.get("input.sacket_qty") }}
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    :tabindex="6"
                                    name="sacket_qty"
                                    id="sacket_qty"
                                    type="text"
                                    class="form-control only-number"
                                    :placeholder="
                                        trans.get(
                                            'input.sacket_qty_placeholder'
                                        )
                                    "
                                    v-model="
                                        InternalDonatedItemModel.data.sacket_qty
                                    "
                                    :disabled="disabled"
                                    v-bind:class="{
                                        'is-invalid':
                                            InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .sacket_qty_hasError,
                                        'is-valid':
                                            InternalDonatedItemModel.InternalDonatedItemSubmited &&
                                            !InternalDonatedItemModel
                                                .InternalDonatedItemValidation
                                                .sacket_qty_hasError
                                    }"
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .sacket_qty_hasError
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .sacket_qty_errorMessage
                                    }}
                                </div>

                                <div
                                    class="valid-feedback"
                                    v-if="
                                        !InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .sacket_qty_hasError &&
                                            InternalDonatedItemModel.InternalDonatedItemSubmited
                                    "
                                >
                                    {{
                                        InternalDonatedItemModel
                                            .InternalDonatedItemValidation
                                            .sacket_qty_successMessage
                                    }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <button
                                :tabindex="9"
                                type="submit"
                                class="btn btn-success m-1"
                                v-if="!disabled"
                                @click="
                                    edit
                                        ? InternalDonatedItemModel.updateItem()
                                        : InternalDonatedItemModel.saveItem()
                                "
                            >
                                {{
                                    edit
                                        ? trans.get("button.update")
                                        : trans.get("button.create")
                                }}
                            </button>
                            <input
                                :tabindex="10"
                                type="submit"
                                class="btn btn-danger m-1"
                                :value="
                                    edit
                                        ? trans.get('button.update_and_confirm')
                                        : trans.get('button.update_and_confirm')
                                "
                                name="update_and_confirm"
                                v-if="!disabled && canConfirm"
                                @click="
                                    edit
                                        ? InternalDonatedItemModel.updateAndConfirm()
                                        : InternalDonatedItemModel.confirmAndSaveItem()
                                "
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
*:focus {
    outline: 0 !important;
    border: 1px solid red;
}
</style>

<script>
import InternalDonatedItem from "../models/internal_donated_item/internal_donated_item";
import AddAlmsRoundComponent from "./AddAlmsRoundComponent";
import select2 from "./select2";
import Loading from "vue-loading-overlay";
import AddItemTypeComponent from "./AddItemTypeComponent.vue";
import AddItemSubTypeComponent from "./AddItemSubTypeComponent.vue";

export default {
    components: {
        select2,
        Loading,
        AddAlmsRoundComponent,
        AddItemTypeComponent,
        AddItemSubTypeComponent
    },
    props: {
        internal_donated_item: { type: Object, default: () => ({}) }
    },
    data: function() {
        return {
            fullPage: false,
            isLoading: false,
            canConfirm: false,
            InternalDonatedItemModel: new InternalDonatedItem(
                this.internal_donated_item
            )
        };
    },
    async mounted() {
        const { data } = await axios.get(
            "/backend/check-permission?permission=create-and-confirm-internal-donated-items"
        );
        this.canConfirm = data;
    },
    computed: {
        edit() {
            return this.InternalDonatedItemModel.data.uuid != "";
        },
        disabled() {
            return this.InternalDonatedItemModel.data.is_confirmed;
        },
        itemTypeDisabled() {
            return !this.InternalDonatedItemModel.data.is_confirmed;
        },
        almsRoundDisabled() {
            return !this.InternalDonatedItemModel.data.is_confirmed;
        },
        itemSubTypeDisabled() {
            return this.InternalDonatedItemModel.data.is_confirmed;
        }
    },
    created() {
        this.$root.$on("startLoading", () => {
            this.isLoading = true;
        });

        this.$root.$on("endLoading", () => {
            this.isLoading = false;
        });

        this.$root.$on("almsRoundSuccess", data => {
            this.InternalDonatedItemModel.data.alms_round_id = data.id;
            this.InternalDonatedItemModel.selectedAlmsRound = data;
        });

        this.$root.$on("itemSubTypeSuccess", data => {
            this.InternalDonatedItemModel.data.item_sub_type_id = data.id;
            this.InternalDonatedItemModel.selectedItemSubType = data;
        });
    }
};
</script>
