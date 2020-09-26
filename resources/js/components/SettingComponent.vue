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
          >Create Country</a>
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
          >Create City</a>
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
          >Create State Region</a>
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
      >Country Create</div>
      <div
        class="tab-pane fade"
        id="country-list"
        role="tabpanel"
        aria-labelledby="country-list-tab"
      >Country List</div>
      <!-- end country -->

      <!-- start state region -->
      <div
        class="tab-pane fade"
        id="state-region-list-create"
        role="tabpanel"
        aria-labelledby="state-region-create-tab"
      >State Region Create</div>
      <div
        class="tab-pane fade"
        id="state-region-list"
        role="tabpanel"
        aria-labelledby="state-region-list-tab"
      >State Region List</div>
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
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in city.model.list.data" :key="item.id">
              <th scope="row">{{index + 1}}</th>
              <td style="max-width:20px">{{item.name}}</td>
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
        <pagination :data="city.model.list" align="center" v-on:pagination-change-page="getCityResult"></pagination>
      </div>
      <!-- end city -->
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import city from "../validations/setting_component/city.js";
import cityModel from "../models/city.js";

export default {
  data: () => ({
    fullPage: false,
    isLoading: false,
    city: {
      validation: new city(),
      model: new cityModel()
    }
  }),
  watch: {
    "city.model.isLoading": function(newisLoading, oldisLoading) {
      this.isLoading = newisLoading;
    },
    "city.model.isCreateSuccess": function(
      newisCreateSuccess,
      oldisCreateSuccess
    ) {
      if (newisCreateSuccess) {
        this.$toasted.show("Saving Success.", { icon: "save" });
      }
    },
    "city.model.isCreateFail": function(newisCreateFail, oldisCreateFail) {
      if (newisCreateFail) {
        this.$toasted.show("Saving Failed.", { icon: "save" });
      }
    },
    "city.model.isUpdateSuccess": function(
      newisUpdateSuccess,
      oldisUpdateSuccess
    ) {
      if (newisUpdateSuccess) {
        this.$toasted.show("Upading Success.", { icon: "save" });
      }
    },
    "city.model.isUpdateFail": function(newisUpdateFail, oldisUpdateFail) {
      if (newisUpdateFail) {
        this.$toasted.show("Updaing Failed.", { icon: "save" });
      }
    },
    "city.model.isDeleteSuccess": function(
      newisDeleteSuccess,
      oldisDeleteSuccess
    ) {
      if (newisDeleteSuccess) {
        this.$toasted.show("Delete Success.", { icon: "delete" });
      }
    },
    "city.model.isDeleteFail": function(newisDeleteFail, oldisDeleteFail) {
      if (newisDeleteFail) {
        this.$toasted.show("Delete Fail.", { icon: "delete" });
      }
    },
    "city.model.validation": function(newValidation, oldValidation) {
      this.city.validation = new city(newValidation);
    }
  },
  components: {
    Loading
  },
  methods: {
    getCityResult(page) {
      this.city.model.fetchList(page)
    }
  },
  mounted() {},
  created() {}
};
</script>