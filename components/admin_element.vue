<template>
  <div>
    <input type="hidden" value="" :name="inputName" />

    <input
      v-if="isTitle"
      type="text"
      :id="inputId + '-title'"
      :placeholder="titlePlaceholder"
      v-model="title"
      class="sfxinput"
    />

    <input
      type="text"
      :id="inputId + '-value'"
      :placeholder="placeholder"
      v-model="value"
      @keydown.enter.prevent="add"
      class="sfxinput"
    />

    <div v-for="(v, k) in extra" :key="k">
      <input
        type="text"
        :id="inputId + '-value-' + k"
        :placeholder="placeholder"
        v-model="extraValues[k]"
        class="sfxinput"
      />
    </div>

    <button
      type="button"
      class="button button-primary sfx-add-button"
      @click.prevent="add"
    >
      {{ addTitle }}
    </button>
    <br />

    <div :id="'sfx-elements-' + inputId" class="sortable">
      <div v-for="(v, k) in added" :key="k" class="sfxelement">
        {{ v.title }}

        <input
          type="hidden"
          :value="v.title"
          :name="generateName(k, 'title')"
        />
        <input
          type="hidden"
          :value="v.value"
          :name="generateName(k, 'value')"
        />

        <span v-for="(vv, kk) in v.extras" :key="kk">
          <input
            type="hidden"
            :value="vv"
            :name="generateName(k, 'extras][')"
          />
        </span>

        <button
          type="button"
          class="button button-danger float-right"
          @click="remove(k)"
        >
          x
        </button>

        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</template>


<script>
(function ($) {
  Vue.component("vue-element", {
    data: function () {
      return {
        title: "",
        value: "",
        added: [],
        extra: [],
        extraValues: [],
      };
    },
    props: [
      "inputId",
      "inputName",
      "placeholder",
      "titlePlaceholder",
      "load",
      "addTitle",
      "isTitle",
      "extraValue",
    ],
    template: ``,
    created() {
      if (this.extraValue) {
        // console.log(this.extraValue);
        for (var index = 0; index < this.extraValue; index++) {
          this.extra[index] = {};
        }
        // console.log(this.extra);
      }

      if (typeof window[this.load] == "undefined") return;
      var obj = JSON.parse(window[this.load]);
      if (!obj) return;
      // console.log(obj);
      this.added = obj;
    },
    computed: {},
    mounted() {},
    watch: {},
    methods: {
      generateName(key, name) {
        return this.inputName + "[" + key + "][" + name + "]";
      },
      add(e) {
        if (!$.trim(this.value)) return;
        // console.log(this.isTitle);
        if (!this.title) this.title = this.value;
        // var key = sfxplugin_idGenerate();

        var ADD = {
          title: this.title,
          value: this.value,
        };

        if (this.extraValues) ADD.extras = this.extraValues;

        // console.log(this.extraValues);

        this.added.push(ADD);
        this.title = "";
        this.value = "";
        this.extraValues = [];
      },
      remove(k) {
        this.added.splice(k, 1);
      },
    },
  });
})(jQuery);
</script>



<style scoped>
</style>