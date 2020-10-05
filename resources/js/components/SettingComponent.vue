<template>
  <div>
    <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item dropdown" role="presentation" style="min-width:150px">
        <a
          class="nav-link dropdown-toggle active"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
        >Office</a>
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="office-list-tab"
            data-toggle="tab"
            href="#office-list"
            role="tab"
            aria-controls="office-list"
            aria-selected="true"
          >Office List</a>
          <a
            class="dropdown-item"
            id="office-list-create-tab"
            data-toggle="tab"
            href="#office-list-create"
            role="tab"
            aria-controls="office-list-create"
            aria-selected="false"
          >Create Office</a>
        </div>
      </li>
      <li class="nav-item dropdown" role="presentation" style="min-width:150px">
        <a
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
        >Country</a>
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="country-list-tab"
            data-toggle="tab"
            href="#country-list"
            role="tab"
            aria-controls="country-list"
            aria-selected="false"
          >Country List</a>
          <a
            class="dropdown-item"
            id="country-list-create-tab"
            data-toggle="tab"
            href="#country-list-create"
            role="tab"
            aria-controls="country-list-create"
            aria-selected="false"
            @click="country.model.clearData()"
          >Create Country</a>
        </div>
      </li>
      <li class="nav-item dropdown" role="presentation" style="min-width:180px">
        <a
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
        >State Region</a>
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="state-region-list-tab"
            data-toggle="tab"
            href="#state-region-list"
            role="tab"
            aria-controls="state-region-list"
            aria-selected="false"
          >State Region List</a>
          <a
            class="dropdown-item"
            id="state-region-list-create-tab"
            href="#state-region-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="city-list-create"
            aria-selected="false"
            @click="stateRegion.model.clearData()"
          >Create State Region</a>
        </div>
      </li>
      <li class="nav-item dropdown" role="presentation" style="min-width:150px">
        <a
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="true"
          aria-expanded="false"
        >City</a>
        <div class="dropdown-menu">
          <a
            class="dropdown-item"
            id="city-list-tab"
            data-toggle="tab"
            href="#city-list"
            role="tab"
            aria-controls="city-list"
            aria-selected="false"
          >City List</a>
          <a
            class="dropdown-item"
            id="city-create-tab"
            href="#city-list-create"
            data-toggle="tab"
            role="tab"
            aria-controls="city-list-create"
            aria-selected="false"
            @click="city.model.clearData()"
          >Create City</a>
        </div>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <!-- start office -->
      <div
        class="tab-pane fade show active"
        id="office-list"
        role="tabpanel"
        aria-labelledby="office-list-tab"
      >office list</div>
      <div
        class="tab-pane fade show"
        id="office-list-create"
        role="tabpanel"
        aria-labelledby="office-list-create-tab"
      >Create Office</div>
      <!-- end office -->

      <!-- start country -->
      <div
        class="tab-pane fade"
        id="country-list-create"
        role="tabpanel"
        aria-labelledby="country-list-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start country name -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': country.validation.name_hasError, 'was-validated': (country.validation.validation != null && !country.validation.name_hasError) }"
            >
              <label for="about_item">
                Country Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="country_name"
                type="text"
                class="form-control"
                placeholder="Country Name"
                v-model="country.model.name"
                v-bind:class="{ 'is-invalid': country.validation.name_hasError }"
              />
              <div class="invalid-feedback">{{country.validation.name_errorMessage}}</div>
              <div class="valid-feedback">{{country.validation.name_successMessage}}</div>
            </div>
            <!-- end country name -->

            <!-- start country is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{ 'has-error': country.validation.is_available_hasError}"
              >
                <input
                  type="checkbox"
                  id="country_is_available"
                  value="1"
                  v-model="country.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{ 'is-invalid': country.validation.is_available_hasError}"
                />
                <label for="country_is_available">
                  Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">{{country.validation.is_available_errorMessage}}</div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="country.model.isEdit"
              @click="country.model.updateCountry()"
              class="btn btn-success"
            >Update</button>
            <button
              v-if="country.model.isEdit"
              @click="country.model.goToList('country-list')"
              class="btn btn-default"
            >Cancel</button>
            <button v-else @click="country.model.saveCountry()" class="btn btn-success">Create</button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="country-list"
        role="tabpanel"
        aria-labelledby="country-list-tab"
      >
        <table class="table table-hover table-dark" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Is Available</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in country.model.list.data" :key="item.id">
              <th scope="row">{{index + 1}}</th>
              <td style="max-width:20px">{{item.name}}</td>
              <td style="max-width:20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                >check_circle</i>
                <i aria-hidden="true" v-else class="material-icons red">cancel</i>
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-country-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >Edit</button>
                <div :id="`edit-collapse-country-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="country.model.editRecord(index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-country-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >No</button>
                </div>
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-danger"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-country-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >Delete</button>
                <div :id="`collapse-country-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="country.model.deleteCountry(item.id, index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-country-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >No</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="country.model.list"
          align="center"
          v-on:pagination-change-page="getCountryResult"
        ></pagination>
      </div>
      <!-- end country -->

      <!-- start state region -->
      <div
        class="tab-pane fade"
        id="state-region-list-create"
        role="tabpanel"
        aria-labelledby="state-region-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start country select2 -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': stateRegion.validation.country_id_hasError, 'was-validated': (stateRegion.validation.country_id_successMessage && !stateRegion.validation.country_id_hasError) }"
            >
              <label for="country-id">
                Select Country
                <span class="text-danger">*</span>
              </label>
              <select2
                :url="country.model.fetchListUrl"
                :value="stateRegion.model.country_id"
                @input="stateRegion.model.countrySelected($event)"
                :selected-option="stateRegion.model.country"
                v-bind:class="{ 'is-invalid': stateRegion.validation.country_id_hasError }"
              ></select2>

              <div class="invalid-feedback">{{stateRegion.validation.country_id_errorMessage}}</div>
              <div
                class="valid-feedback"
                style="display:block"
              >{{stateRegion.validation.country_id_successMessage}}</div>
            </div>
            <!-- end country select2 -->

            <!-- start state region name -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': stateRegion.validation.name_hasError, 'was-validated': (stateRegion.validation.name_successMessage && !stateRegion.validation.name_hasError) }"
            >
              <label for="about_item">
                State Or Region Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="state_region_name"
                type="text"
                class="form-control"
                placeholder="State Or Region Name"
                v-model="stateRegion.model.name"
                v-bind:class="{ 'is-invalid': stateRegion.validation.name_hasError }"
              />
              <div class="invalid-feedback">{{stateRegion.validation.name_errorMessage}}</div>
              <div class="valid-feedback">{{stateRegion.validation.name_successMessage}}</div>
            </div>
            <!-- end state region name -->

            <!-- start state region name -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': stateRegion.validation.code_hasError, 'was-validated': (stateRegion.validation.code_successMessage && !stateRegion.validation.code_hasError) }"
            >
              <label for="about_item">
                State Or Region Code
                <span class="text-danger">*</span>
              </label>
              <input
                id="state_region_code"
                type="text"
                class="form-control only-number"
                placeholder="State Or Region Code"
                v-model="stateRegion.model.code"
                v-bind:class="{ 'is-invalid': stateRegion.validation.code_hasError }"
              />
              <div class="invalid-feedback">{{stateRegion.validation.code_errorMessage}}</div>
              <div class="valid-feedback">{{stateRegion.validation.code_successMessage}}</div>
            </div>
            <!-- end state region name -->

            <!-- start state region is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{ 'has-error': stateRegion.validation.is_available_hasError}"
              >
                <input
                  type="checkbox"
                  id="state_region_is_available"
                  value="1"
                  v-model="stateRegion.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{ 'is-invalid': stateRegion.validation.is_available_hasError}"
                />
                <label for="state_region_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">{{stateRegion.validation.is_available_errorMessage}}</div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="stateRegion.model.isEdit"
              @click="stateRegion.model.updateStateRegion()"
              class="btn btn-success"
            >Update</button>
            <button
              v-if="stateRegion.model.isEdit"
              @click="stateRegion.model.goToList()"
              class="btn btn-default"
            >Cancel</button>
            <button
              v-else
              @click="stateRegion.model.saveStateRegion()"
              class="btn btn-success"
            >Create</button>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="state-region-list"
        role="tabpanel"
        aria-labelledby="state-region-list-tab"
      >
        <table class="table table-hover table-dark" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">Country</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in stateRegion.model.list.data" :key="item.id">
              <th scope="row">{{index + 1}}</th>
              <td style="max-width:20px">{{item.name}}</td>
              <td style="max-width:20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                >check_circle</i>
                <i aria-hidden="true" v-else class="material-icons red">cancel</i>
              </td>
              <td>
                <i
                  aria-hidden="true"
                  v-if="item.country ? item.country.is_available == 1 : ''"
                  class="material-icons green"
                >check_circle</i>
                <i
                  aria-hidden="true"
                  v-else-if="(item.country) ? item.country.is_available == 0 : ''"
                  class="material-icons red"
                >cancel</i>
                {{item.country ? item.country.name : '-'}}
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-state-region-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >Edit</button>
                <div :id="`edit-collapse-state-region-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="stateRegion.model.editRecord(index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-state-region-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >No</button>
                </div>
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-danger"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-state-region-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >Delete</button>
                <div :id="`collapse-state-region-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="stateRegion.model.deleteStateRegion(item.id, index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-state-region-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >No</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="stateRegion.model.list"
          align="center"
          v-on:pagination-change-page="getStateRegionResult"
        ></pagination>
      </div>
      <!-- end state region -->

      <!-- start city -->
      <div
        class="tab-pane fade row"
        id="city-list-create"
        role="tabpanel"
        aria-labelledby="city-create-tab"
      >
        <div class="col-md-6 card border border-success">
          <div class="card-body">
            <!-- start state region select2 -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': city.validation.state_region_id_hasError, 'was-validated': (city.validation.state_region_id_successMessage && !city.validation.state_region_id_hasError) }"
            >
              <label for="country-id">
                Select State Region
                <span class="text-danger">*</span>
              </label>
              <select2
                :url="stateRegion.model.fetchListUrl"
                :value="city.model.state_region_id"
                @input="city.model.stateRegionSelected($event)"
                :selected-option="city.model.stateRegion"
                v-bind:class="{ 'is-invalid': city.validation.state_region_id_hasError }"
              ></select2>

              <div class="invalid-feedback">{{city.validation.state_region_id_errorMessage}}</div>
              <div
                class="valid-feedback"
                style="display:block"
              >{{city.validation.state_region_id_successMessage}}</div>
            </div>
            <!-- end state region select2 -->

            <!-- start city name -->
            <div
              class="form-group"
              v-bind:class="{ 'has-error': city.validation.name_hasError, 'was-validated': (city.validation.validation != null && !city.validation.name_hasError) }"
            >
              <label for="about_item">
                City Name
                <span class="text-danger">*</span>
              </label>
              <input
                id="city_name"
                type="text"
                class="form-control"
                placeholder="City Name"
                v-model="city.model.name"
                v-bind:class="{ 'is-invalid': city.validation.name_hasError }"
              />
              <div class="invalid-feedback">{{city.validation.name_errorMessage}}</div>
              <div class="valid-feedback">{{city.validation.name_successMessage}}</div>
            </div>
            <!-- end city name -->

            <!-- start city is_available -->
            <div class="col-sm-offset-2 col-sm-10">
              <div
                class="checkbox"
                v-bind:class="{ 'has-error': city.validation.is_available_hasError}"
              >
                <input
                  type="checkbox"
                  id="city_is_available"
                  value="1"
                  v-model="city.model.is_available"
                  true-value="1"
                  false-value="0"
                  v-bind:class="{ 'is-invalid': city.validation.is_available_hasError}"
                />
                <label for="city_is_available">
                  Is Available
                  <span class="text-danger">*</span>
                </label>
                <div class="invalid-feedback">{{city.validation.is_available_errorMessage}}</div>
              </div>
            </div>
            <!-- end city is_available -->
            <button
              v-if="city.model.isEdit"
              @click="city.model.updateCity()"
              class="btn btn-success"
            >Update</button>
            <button
              v-if="city.model.isEdit"
              @click="city.model.goToList('city-list')"
              class="btn btn-default"
            >Cancel</button>
            <button v-else @click="city.model.saveCity()" class="btn btn-success">Create</button>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="city-list" role="tabpanel" aria-labelledby="city-list-tab">
        <table class="table table-hover table-dark" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Available</th>
              <th scope="col">State Or Region</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in city.model.list.data" :key="item.id">
              <th scope="row">{{index + 1}}</th>
              <td style="max-width:20px">{{item.name}}</td>
              <td style="max-width:20px">
                <i
                  aria-hidden="true"
                  v-if="item.is_available == 1"
                  class="material-icons green"
                >check_circle</i>
                <i aria-hidden="true" v-else class="material-icons red">cancel</i>
              </td>
              <td style="max-width:20px">
                <i
                  aria-hidden="true"
                  v-if="(item.stateRegion) ? item.stateRegion.is_available == 1 : ''"
                  class="material-icons green"
                >check_circle</i>
                <i
                  aria-hidden="true"
                  v-else-if="(item.stateRegion) ? item.stateRegion.is_available == 0 : ''"
                  class="material-icons red"
                >cancel</i>
                {{item.stateRegion ? item.stateRegion.name : '-' }}
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-warning"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#edit-collapse-${item.id}`"
                  aria-expanded="false"
                  aria-controls="editCollapseExample"
                >Edit</button>
                <div :id="`edit-collapse-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="city.model.editRecord(index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#edit-collapse-${item.id}`"
                    aria-expanded="false"
                    aria-controls="editCollapseExample"
                  >No</button>
                </div>
              </td>
              <td style="max-width:20px">
                <button
                  class="btn btn-outline-danger"
                  type="button"
                  data-toggle="collapse"
                  :data-target="`#collapse-${item.id}`"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >Delete</button>
                <div :id="`collapse-${item.id}`" class="collapse p-1">
                  <button
                    class="btn btn-sm btn-outline-danger"
                    @click="city.model.deleteCity(item.id, index)"
                  >Yes</button>
                  <button
                    class="btn btn-sm btn-default"
                    data-toggle="collapse"
                    :data-target="`#collapse-${item.id}`"
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >No</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :data="city.model.list"
          align="center"
          v-on:pagination-change-page="getCityResult"
        ></pagination>
      </div>
      <!-- end city -->
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import cityValidation from "../validations/setting_component/city.js";
import cityModel from "../models/city.js";
import countryValidation from "../validations/setting_component/country.js";
import countryModel from "../models/country.js";
import stateRegionValidation from "../validations/setting_component/state_region.js";
import stateRegionModel from "../models/state_region.js";
import select2 from "./select2";

export default {
  data: () => ({
    fullPage: false,
    isLoading: false,
    city: {
      validation: new cityValidation(),
      model: new cityModel()
    },
    country: {
      validation: new countryValidation(),
      model: new countryModel()
    },
    stateRegion: {
      validation: new stateRegionValidation(),
      model: new stateRegionModel()
    }
  }),
  computed: {
    isLoadingWatch() {
      return (
        this.city.model.isLoading ||
        this.country.model.isLoading ||
        this.stateRegion.model.isLoading
      );
    },
    isCreateSuccessWatch() {
      return (
        this.city.model.isCreateSuccess ||
        this.country.model.isCreateSuccess ||
        this.stateRegion.model.isCreateSuccess
      );
    },
    isCreateFailWatch() {
      return (
        this.city.model.isCreateFail ||
        this.country.model.isCreateFail ||
        this.stateRegion.model.isCreateFail
      );
    },
    isUpdateSuccessWatch() {
      return (
        this.city.model.isUpdateSuccess ||
        this.country.model.isUpdateSuccess ||
        this.stateRegion.model.isUpdateSuccess
      );
    },
    isUpdateFailWatch() {
      return (
        this.city.model.isUpdateFail ||
        this.country.model.isUpdateFail ||
        this.stateRegion.model.isUpdateFail
      );
    },
    isDeleteSuccessWatch() {
      return (
        this.city.model.isDeleteSuccess ||
        this.country.model.isDeleteSuccess ||
        this.stateRegion.model.isDeleteSuccess
      );
    },
    isDeleteFailWatch() {
      return (
        this.city.model.isDeleteFail ||
        this.country.model.isDeleteFail ||
        this.stateRegion.model.isDeleteFail
      );
    }
  },
  watch: {
    isLoadingWatch: function(newisLoading, oldisLoading) {
      this.isLoading = newisLoading;
    },
    isCreateSuccessWatch: function(newisCreateSuccess, oldisCreateSuccess) {
      if (newisCreateSuccess) {
        this.$toasted.show("Saving Success.", { icon: "save" });
        this.stateRegion.model.fetchList(this.stateRegion.model.page);
        this.city.model.fetchList(this.city.model.page);
        this.$forceUpdate();
      }
    },
    isCreateFailWatch: function(newisCreateFail, oldisCreateFail) {
      if (newisCreateFail) {
        this.$toasted.show("Saving Failed.", { icon: "save" });
      }
    },
    isUpdateSuccessWatch: function(newisUpdateSuccess, oldisUpdateSuccess) {
      if (newisUpdateSuccess) {
        this.$toasted.show("Upading Success.", { icon: "save" });
        this.stateRegion.model.fetchList(this.stateRegion.model.page);
        this.city.model.fetchList(this.city.model.page);
        this.$forceUpdate();
      }
    },
    isUpdateFailWatch: function(newisUpdateFail, oldisUpdateFail) {
      if (newisUpdateFail) {
        this.$toasted.show("Updaing Failed.", { icon: "save" });
      }
    },
    isDeleteSuccessWatch: function(newisDeleteSuccess, oldisDeleteSuccess) {
      if (newisDeleteSuccess) {
        this.$toasted.show("Delete Success.", { icon: "delete" });
        this.stateRegion.model.fetchList(this.stateRegion.model.page);
        this.city.model.fetchList(this.city.model.page);
        this.$forceUpdate();
      }
    },
    isDeleteFailWatch: function(newisDeleteFail, oldisDeleteFail) {
      if (newisDeleteFail) {
        this.$toasted.show("Delete Fail.", { icon: "delete" });
      }
    },
    "city.model.validation": function(newValidation, oldValidation) {
      this.city.validation = new cityValidation(newValidation);
    },
    "country.model.validation": function(newValidation, oldValidation) {
      this.country.validation = new countryValidation(newValidation);
    },
    "stateRegion.model.validation": function(newValidation, oldValidation) {
      this.stateRegion.validation = new stateRegionValidation(newValidation);
    }
  },
  components: {
    Loading,
    select2
  },
  methods: {
    getCityResult(page) {
      this.city.model.page = page;
      this.city.model.fetchList(page);
    },
    getCountryResult(page) {
      this.country.model.page = page;
      this.country.model.fetchList(page);
    },
    getStateRegionResult(page) {
      this.stateRegion.model.page = page;
      this.stateRegion.model.fetchList(page);
    }
  },
  mounted() {},
  created() {}
};
</script>

<style scoped>
.material-icons.red {
  color: red;
}
.material-icons.green {
  color: green;
}
</style>