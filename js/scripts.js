/**
 * Components
 */
import { navigation } from "./components/navigation/navigation";
import { productModelList } from "./components/blocks/product/product-model-list";
import { modelInfo } from "./components/blocks/model/model-info";

jQuery(document).ready(function ($) {
    navigation($);
    productModelList($);
    modelInfo($);
});