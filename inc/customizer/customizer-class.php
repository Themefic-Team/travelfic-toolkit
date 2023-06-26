<?php

// Image Select Class
class Travelfic_Image_Select_Control extends WP_Customize_Control {
    public $type = 'image_select';

    public function render_content() {
        $image_options = $this->choices;
        $value = $this->value();
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <ul class="image-select-container">
            <?php foreach ( $image_options as $key => $image_url ) : ?>
                <li>
                <label>
                    <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $value, $key ); ?>/>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $key ); ?>"/>
                </label>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php
    }
}

// Tab Select Class
class Travelfic_Tab_Select_Control extends WP_Customize_Control {
    public $type = 'tab_select';

    public function render_content() {
        $tab_options = $this->choices;
        $value = $this->value();
        ?>
            <ul class="tab-select-container">
            <?php foreach ( $tab_options as $key => $label ) : ?>
                <li>
                <label>
                    <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $value, $key ); ?>/>
                    <span><?php echo esc_html($label); ?></span>
                </label>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php
    }
}

// Section Heading Class
class Travelfic_Sec_Section_Control extends WP_Customize_Control {
    public $type = 'sec_section';

    public function render_content() {
    ?>
        <span class="travelfic-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <?php
    }
}

// Typography Class
class Travelfic_typography_Control extends WP_Customize_Control {
    public $type = 'typography';

    public function render_content() {
        $value = $this->value();

        // If the value is an array, retrieve the individual field values
        if (is_array($value)) {
            $lineHeight = isset($value['line-height']) ? $value['line-height'] : '';
            $fontSize = isset($value['font-size']) ? $value['font-size'] : '';
            $textTransform = isset($value['text-transform']) ? $value['text-transform'] : '';
        } else {
            // If the value is not an array, set default values
            $lineHeight = $this->get_default('line-height');
            $fontSize = $this->get_default('font-size');
            $textTransform = $this->get_default('text-transform');
        }
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) { ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>

            <?php $this->generate_fields($lineHeight, $fontSize, $textTransform); ?>
        </label>
        <?php
    }

    private function get_default($field) {
        $defaults = array(
            'font-size'      => '16',
            'line-height'      => '16',
            'text-transform' => 'none',
        );

        return isset($defaults[$field]) ? $defaults[$field] : '';
    }

    private function generate_fields($lineHeight, $fontSize, $textTransform) {
        $fields = array(
            'font-size' => array(
                'label' => 'Font Size (PX)',
                'type' => 'text',
                'value' => $fontSize, // Pass the font-size value
            ),
            'line-height' => array(
                'label' => 'Line Height (PX)',
                'type' => 'text',
                'value' => $lineHeight, // Pass the line-height value
            ),
            'text-transform' => array(
                'label' => 'Text Transform',
                'type' => 'select',
                'options' => array(
                    'none' => 'None',
                    'capitalize' => 'Capitalize',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                ),
                'value' => $textTransform, // Pass the text-transform value
            ),
        );

        foreach ($fields as $field_id => $field) {
            $value = isset($field['value']) ? $field['value'] : '';
        
            ?>
            <p>
                <label>
                    <span class="customize-control-subtitle"><?php echo esc_html($field['label']); ?></span>
                    <?php
                    if ('select' === $field['type']) {
                        ?>
                        <select <?php $this->link($field_id); ?> data-customize-setting-link="<?php echo $field_id; ?>">
                            <?php
                            foreach ($field['options'] as $option_value => $option_label) {
                                printf(
                                    '<option value="%s" %s>%s</option>',
                                    esc_attr($option_value),
                                    selected($value, $option_value, false),
                                    esc_html($option_label)
                                );
                            }
                            ?>
                        </select>
                        <?php
                    } else {
                        ?>
                        <input type="number" <?php $this->link($field_id); ?> data-customize-setting-link="<?php echo $field_id; ?>" value="<?php echo esc_attr($value); ?>">
                        <?php
                    }
                    ?>
                </label>
            </p>
            <?php
        }
        
    }
}