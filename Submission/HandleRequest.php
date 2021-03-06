<?php

declare(strict_types=1);

namespace EMS\FormBundle\Submission;

use EMS\FormBundle\FormConfig\FormConfig;
use EMS\FormBundle\FormConfig\SubmissionConfig;
use Symfony\Component\Form\FormInterface;

final class HandleRequest implements HandleRequestInterface
{
    /** @var FormInterface */
    private $form;
    /** @var FormData */
    private $formData;
    /** @var FormConfig */
    private $formConfig;
    /** @var HandleResponseCollector */
    private $responseCollector;
    /** @var SubmissionConfig */
    private $submissionConfig;

    public function __construct(
        FormInterface $form,
        FormConfig $formConfig,
        HandleResponseCollector $responseCollector,
        SubmissionConfig $submissionConfig
    ) {
        $this->form = $form;
        $this->formData = new FormData($formConfig, $form);
        $this->formConfig = $formConfig;
        $this->responseCollector = $responseCollector;
        $this->submissionConfig = $submissionConfig;
    }

    public function addResponse(HandleResponseInterface $response): void
    {
        $this->responseCollector->addResponse($response);
    }

    public function getClass(): string
    {
        return $this->submissionConfig->getClass();
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }

    public function getFormData(): FormData
    {
        return $this->formData;
    }

    public function getFormConfig(): FormConfig
    {
        return $this->formConfig;
    }

    public function getEndPoint(): string
    {
        return $this->submissionConfig->getEndpoint();
    }

    public function getMessage(): string
    {
        return $this->submissionConfig->getMessage();
    }

    public function getResponses(): array
    {
        return $this->responseCollector->getResponses();
    }
}
