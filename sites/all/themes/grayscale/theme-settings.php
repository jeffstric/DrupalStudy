<?php

function grayscale_form_system_theme_settings_alter(&$form, &$form_state) {
    $form['styles'] = array(
        '#type' => 'fieldset',
        '#title' => t('Style settings'),
        '#collapsible' => FALSE,
        '#collapsed' => FALSE,
    );
    $form['styles']['font'] = array(
        '#type' => 'fieldset',
        '#title' => t('Font settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );
    $form['styles']['font']['font_family'] = array(
        '#type' => 'select',
        '#title' => t('Font family'),
        '#default_value' => theme_get_setting('font_family'),
        '#options' => array(
            'ff-sss' => t('Helvetica Nueue, Trebuchet MS, Arial, Nimbus Sans L, FreeSans, sans-
serif'),
            'ff-ssl' => t('Verdana, Geneva, Arial, Helvetica, sans-serif'),
            'ff-a'
            => t('Arial, Helvetica, sans-serif'),
            'ff-ss' => t('Garamond, Perpetua, Nimbus Roman No9 L, Times New Roman, serif'),
            'ff-sl' => t('Baskerville, Georgia, Palatino, Palatino Linotype, Book Antiqua, URW
Palladio L, serif'),
            'ff-m'
            => t('Myriad Pro, Myriad, Arial, Helvetica, sans-serif'),
            'ff-l'
            => t('Lucida Sans, Lucida Grande, Lucida Sans Unicode, Verdana, Geneva,
sans-serif'),
        ),
    );
    $form['styles']['font']['font_size'] = array(
        '#type' => 'select',
        '#title' => t('Font size'),
        '#default_value' => theme_get_setting('font_size'),
        '#description' => t('Font sizes are always set in relative units - the sizes shown are
the pixel value equivalent.'),
        '#options' => array(
            'fs-10' => t('10px'),
            'fs-11' => t('11px'),
            'fs-12' => t('12px'),
            'fs-13' => t('13px'),
            'fs-14' => t('14px'),
            'fs-15' => t('15px'),
            'fs-16' => t('16px'),
        ),
    );
}
