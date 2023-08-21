<?php

namespace Lzy\Express;

use Lzy\Express\Exceptions\InvalidArgumentException;


class Express
{
    protected $type;

    protected $app_id;

    protected $app_key;

    /**
     * Express constructor.
     *
     * @param string $app_id
     * @param string $app_key
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    public function __construct($app_id, $app_key, string $type = 'Kuaidi100Express')
    {
        if (empty($app_id)) {
            throw new InvalidArgumentException('APP Id Can not be empty');
        }

        if (empty($app_key)) {
            throw new InvalidArgumentException('APP key Can not be empty');
        }

        if (!in_array(strtolower($type), ['Kuaidi100Express', 'KuaidiBirdExpress'])) {
            throw new InvalidArgumentException('Unsupported Type');
        }

        $this->type = $type;
        $this->app_id = $app_id;
        $this->app_key = $app_key;
    }

    /**
     * 查询物流
     *
     * @param $tracking_code
     * @param $shipping_code
     * @param array $additional
     *
     * @return string
     *
     * @throws Exceptions\HttpException
     * @throws InvalidArgumentException
     */
    public function track($tracking_code, $shipping_code, $additional = [])
    {
        if ('Kuaidi100Express' === $this->type) {
            if (isset($additional['phone'])) {
                $phone = $additional['phone'];
            } else {
                $phone = '';
            }
            $express = new Kuaidi100Express($this->app_id, $this->app_key);

            return $express->query($tracking_code, $shipping_code, $phone);
        }

        if ('KuaidiBirdExpress' === $this->type) {
            $express = new KuaidiBirdExpress($this->app_id, $this->app_key);
            return $express->query($tracking_code, $shipping_code);
        }
        return [];
    }
}