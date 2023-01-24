<?php

namespace Generic\Elements;

class Helper
{
    public static function get_widgets()
    {
        return [
            'hero' => [
                'title' => esc_html__('Hero', 'generic-elements'),
                'icon'  => 'eicon-tabs'
            ],
            'postlist' => [
                'title' => esc_html__('Post List', 'generic-elements'),
                'icon'  => 'eicon-tabs'
            ],
            'testimonial' => [
                'title' => esc_html__('Testimonial', 'generic-elements'),
                'icon'  => 'eicon-tabs'
            ],
            'team' => [
                'title' => esc_html__('Team', 'generic-elements'),
                'icon'  => 'eicon-person'
            ],
            'slider' => [
                'title' => esc_html__('Slider', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'heading' => [
                'title' => esc_html__('Heading', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'instagram' => [
                'title' => esc_html__('Instagram', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'CallToAction' => [
                'title' => esc_html__('Call To Action', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'VideoInfo' => [
                'title' => esc_html__('Video Info', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'FunFactor' => [
                'title' => esc_html__('Fun Factor', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'InfoBox' => [
                'title' => esc_html__('Info Box', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'ContactForm7' => [
                'title' => esc_html__('Contact Form 7', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'Skill' => [
                'title' => esc_html__('Skill', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
            'Card' => [
                'title' => esc_html__('Card', 'generic-elements'),
                'icon'  => 'eicon-slider-full-screen'
            ],
        ];
    }
}
