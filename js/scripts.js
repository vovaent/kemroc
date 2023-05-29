/**
 * Components
 */
import { navigation } from "./components/navigation";
import { modelList } from "./components/blocks/product/model-list";

jQuery(document).ready(function ($) {
    navigation($);
    modelList();
});