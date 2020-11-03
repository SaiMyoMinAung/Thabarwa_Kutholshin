<template>
  <div>
    <button
      @click.prevent="toggleConfirm"
      class="btn"
      :class="[addClass, { 'd-none': confirm }]"
    >
      {{ text }}
    </button>
    <button
      @click.prevent="confirmed"
      class="btn btn-sm btn-danger"
      :class="{ 'd-none': !confirm }"
    >
      Yes
    </button>
    <button
      @click.prevent="toggleConfirm"
      class="btn btn-sm btn-warning"
      :class="{ 'd-none': !confirm }"
    >
      No
    </button>
  </div>
</template>

<script>
export default {
  props: ["text", "addClass"],
  data() {
    return {
      confirm: false,
    };
  },
  methods: {
    confirmed() {
      this.$emit("confirmed");
      this.confirm = !this.confirm;
    },
    toggleConfirm() {
      this.confirm = !this.confirm;
    },
  },
};
</script>