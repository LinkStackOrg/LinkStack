name: Issue template
description: Please include the following information in your issue.

body:
  - type: input
    id: affected-versions
    attributes:
      label: LinkStack version
      placeholder: x.y.z
    validations:
      required: true
  - type: textarea
    id: description
    attributes:
      label: Description
      description: A clear and concise description of the problem
    validations:
      required: true
  - type: textarea
    id: system-details
    attributes:
      label: Details about your system
      description: |
        OS, PHP version, etc.
    validations:
      required: true
  - type: textarea
    id: how-to-reproduce
    attributes:
      label: How to reproduce
      description: |
        Without a means to replicate your problem, it's challenging for us to assist and find a solution.
        Kindly provide the necessary code and configuration to facilitate easier issue reproduction.
    validations:
      required: true
  - type: textarea
    id: possible-solution
    attributes:
      label: Possible Solution
      description: |
        If applicable.
  - type: textarea
    id: additional-context
    attributes:
      label: Additional Context
      description: "Any other context about the problem: log messages, screenshots, etc."
