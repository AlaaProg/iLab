"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_Profile_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _iconify_vue2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @iconify/vue2 */ "./node_modules/@iconify/vue2/dist/iconify.mjs");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    Icon: _iconify_vue2__WEBPACK_IMPORTED_MODULE_0__.Icon
  },
  computed: {
    profile: function profile() {
      var profile = this.$store.state.auth.profile;
      this.avatar = "storage/".concat(profile.avatar);
      return profile;
    },
    isLoading: function isLoading() {
      return this.$store.state.auth.isLoadingProfile;
    }
  },
  data: function data() {
    return {
      avatar: ''
    };
  },
  methods: {
    submit: function submit() {
      var fd = new FormData(this.$refs.form);

      if (!fd.get("password")) {
        fd["delete"]("password");
      }

      if (!this.isLoading) {
        this.$store.dispatch("auth/updateProfile", fd);
      }
    },
    selectImage: function selectImage() {
      var _this = this;

      var file = this.$refs.avatar.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        _this.avatar = e.target.result;
      };

      reader.readAsDataURL(file);
    }
  }
});

/***/ }),

/***/ "./resources/js/views/Profile.vue":
/*!****************************************!*\
  !*** ./resources/js/views/Profile.vue ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Profile.vue?vue&type=template&id=25b9215a& */ "./resources/js/views/Profile.vue?vue&type=template&id=25b9215a&");
/* harmony import */ var _Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Profile.vue?vue&type=script&lang=js& */ "./resources/js/views/Profile.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__.render,
  _Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Profile.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/Profile.vue?vue&type=script&lang=js&":
/*!*****************************************************************!*\
  !*** ./resources/js/views/Profile.vue?vue&type=script&lang=js& ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Profile.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Profile.vue?vue&type=template&id=25b9215a&":
/*!***********************************************************************!*\
  !*** ./resources/js/views/Profile.vue?vue&type=template&id=25b9215a& ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Profile_vue_vue_type_template_id_25b9215a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Profile.vue?vue&type=template&id=25b9215a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=template&id=25b9215a&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=template&id=25b9215a&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/Profile.vue?vue&type=template&id=25b9215a& ***!
  \**************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "flex items-center  h-full w-full md:px-12" },
    [
      _c(
        "form",
        {
          ref: "form",
          staticClass: "md:w-1/3 w-full",
          on: {
            submit: function ($event) {
              $event.preventDefault()
              return _vm.submit.apply(null, arguments)
            },
          },
        },
        [
          _c("h1", { staticClass: "text-xl text-gray-800 p-8" }, [
            _vm._v(
              "\n            Hello , " +
                _vm._s(_vm.profile.username) +
                "\n        "
            ),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "field" }, [
            _c("input", {
              ref: "avatar",
              attrs: {
                type: "file",
                placeholder: "Avatar",
                hidden: "",
                name: "avatar",
              },
              on: { change: _vm.selectImage },
            }),
            _vm._v(" "),
            _c("div", { staticClass: "w-52 h-52 relative border" }, [
              _c("img", {
                staticClass: "w-full h-full",
                attrs: { src: _vm.avatar, alt: "" },
              }),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "absolute bottom-0 left-0 w-full p-2 bg-gray-500 bg-opacity-30",
                },
                [
                  _c(
                    "a",
                    {
                      staticClass:
                        "w-full cursor-pointer flex items-center justify-center",
                      on: {
                        click: function ($event) {
                          return _vm.$refs.avatar.click()
                        },
                      },
                    },
                    [
                      _c("Icon", {
                        staticClass: "text-4xl",
                        attrs: { icon: "codicon:cloud-upload" },
                      }),
                    ],
                    1
                  ),
                ]
              ),
            ]),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "field" }, [
            _c("input", {
              attrs: { type: "text", name: "name", placeholder: "Name" },
              domProps: { value: _vm.profile.name },
            }),
          ]),
          _vm._v(" "),
          _vm.profile.role == "sick" && _vm.profile.info
            ? [
                _c("div", { staticClass: "field" }, [
                  _c("input", {
                    attrs: { type: "text", name: "age", placeholder: "Age" },
                    domProps: { value: _vm.profile.info.age },
                  }),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "field" }, [
                  _c(
                    "select",
                    {
                      attrs: { name: "gender" },
                      domProps: { value: _vm.profile.info.gender },
                    },
                    [
                      _c("option", { attrs: { value: "null", disabled: "" } }, [
                        _vm._v("Select Gender"),
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "male" } }, [
                        _vm._v("Male"),
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "female" } }, [
                        _vm._v("Female"),
                      ]),
                    ]
                  ),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "field" }, [
                  _c("input", {
                    attrs: {
                      type: "text",
                      name: "phone",
                      placeholder: "Phone",
                    },
                    domProps: { value: _vm.profile.info.phone },
                  }),
                ]),
              ]
            : _vm._e(),
          _vm._v(" "),
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "p-3" }, [
            _c(
              "button",
              { staticClass: "btn btn-blue", attrs: { type: "submit" } },
              [
                !_vm.isLoading
                  ? [_vm._v("\n                    Save\n                ")]
                  : [
                      _vm._v(
                        "\n                    loading ...\n                "
                      ),
                    ],
              ],
              2
            ),
          ]),
        ],
        2
      ),
    ]
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "field" }, [
      _c("input", {
        attrs: { type: "password", name: "password", placeholder: "Password" },
      }),
    ])
  },
]
render._withStripped = true



/***/ })

}]);