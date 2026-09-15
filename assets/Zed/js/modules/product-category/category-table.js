/**
 * Copyright (c) 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

var tableAccess = require('ZedGuiModules/libs/table/table-access');
var categoryTree = require('./category-tree');
var categoryHandle;

/**
 * @param {string} selector
 *
 * @return {void}
 */
function initialize(selector) {
    var categoryTable = document.querySelector(selector);

    if (!categoryTable) {
        return;
    }

    categoryTree.initialize();

    $(categoryTable).on('click', 'tbody > tr:not(.child)', tableRowSelect);

    tableAccess.requestTable(categoryTable, function (handle) {
        categoryHandle = handle;

        handle.on('draw', selectFirstRow);

        handle.raw().on('select', loadCategoryTree).on('deselect', resetCategoryTree);
    });
}

/**
 * @return {void}
 */
function tableRowSelect() {
    selectRow(this);
}

/**
 * @return {void}
 */
function selectFirstRow() {
    selectRow(0);
}

/**
 * @param {Object|number} row - Row node or row index.
 *
 * @return {void}
 */
function selectRow(row) {
    var api = categoryHandle.raw();

    api.rows().deselect();
    api.row(row).select();
}

/**
 * @return {void}
 */
function loadCategoryTree(e, api, type, indexes) {
    var rowData = api.row(indexes[0]).data();
    categoryTree.load(rowData[0]);
}

/**
 * @return {void}
 */
function resetCategoryTree() {
    categoryTree.reset();
}

/**
 * Open public methods
 */
module.exports = {
    initialize: initialize,
};
